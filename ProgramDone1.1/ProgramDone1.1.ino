#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ArduinoJson.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include "icon.h"

// Initialize pins for RFID
#define RST_PIN 22
#define SS_PIN 21
#define RELAY_PIN 27
byte buzzer = 2; // pin GPIO2
MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance

// Initialize OLED
#define OLED_SDA 5
#define OLED_SCL 4
#define OLED_ADDR 0x3C
Adafruit_SSD1306 display(128, 64, &Wire, -1);

const char* ssid = "ZTE_2.4G_77GCk6"; // Your Wifi SSID
const char* password = "CdhKgzFp"; // Wifi Password
String server_addr = "192.168.1.6:8080"; // your server address or computer IP

String UIDCard;
unsigned long relayOnTime = 0; // Store the time when relay was turned on
bool relayActive = false; // Flag to indicate if relay is active

void setup() {
  pinMode(RELAY_PIN, OUTPUT);
  pinMode(buzzer, OUTPUT);
  digitalWrite(RELAY_PIN, LOW);
  Serial.begin(115200); // Initialize serial communications with the PC
  SPI.begin(); // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522 card
  Serial.println(F("Read Uid data on a MIFARE PICC:")); // shows in serial that it is ready to read
  ShowReaderDetails(); // Show details of PCD - MFRC522 Card Reader details

  // Initialize I2C communication with specified pins
  Wire.begin(OLED_SDA, OLED_SCL);

  display.begin(SSD1306_SWITCHCAPVCC, OLED_ADDR);
  display.clearDisplay();
  display.setTextColor(WHITE);
  display.setTextSize(1);
  display.setCursor(38, 20); display.println(F("WareBox"));
  display.setCursor(35, 35); display.println(F("Locker Digital"));
  display.display();
  delay(1000);
  ConnectWIFI();
}

void loop() {
  unsigned long currentMillis = millis();
  display.clearDisplay();
  display.drawBitmap(32, 0, cardBitmap, 68, 50, WHITE);
  display.setTextSize(1);
  display.setCursor(30, 55); display.print("Tap Your Card!");
  display.display();

  if (relayActive && (currentMillis - relayOnTime >= 5000)) { // Check if 5 seconds have passed
    digitalWrite(RELAY_PIN, LOW); // Turn off relay
    relayActive = false; // Reset relay flag
    Serial.println("Relay turned off.");
    mfrc522.PCD_Init(); // Reinitialize the RFID reader after relay is turned off
  } else if (!relayActive) { // Only read card if relay is not active
    if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
      UIDCard = "";
      for (uint8_t i = 0; i < mfrc522.uid.size; i++) {
        UIDCard += String(mfrc522.uid.uidByte[i], HEX);
      }
      UIDCard.toUpperCase(); // Capitalize
      Serial.print("UID:");
      Serial.println(UIDCard);
      Serial.println(F("**End Reading**"));

      beepBuzzer(); // Beep to indicate successful read

      storeData(); // store data to DB

      mfrc522.PICC_HaltA(); // Stop reading
      relayOnTime = millis(); // Record the time when relay is turned on
      relayActive = true; // Set relay active flag
    }
  }
}

void beepBuzzer() {
  for (int i = 0; i < 2; i++) {
    digitalWrite(buzzer, HIGH);
    delay(200);
    digitalWrite(buzzer, LOW);
    delay(200);
  }
}

void storeData() {
  if (WiFi.status() != WL_CONNECTED) {
    ConnectWIFI(); // Reconnect if WiFi is not connected
  }

  WiFiClient client;
  String address = "http://" + server_addr + "/warebox/webapi/api/create.php?uid=" + UIDCard;

  HTTPClient http;
  http.begin(client, address);
  int httpCode = http.GET(); // Send the GET request
  String payload;
  Serial.print("Response: ");
  if (httpCode > 0) { // Check the returning code
    payload = http.getString(); // Get the request response payload
    payload.trim(); // remove \n character
    if (payload.length() > 0) {
      Serial.println(payload + "\n");
    }
  }
  http.end(); // Close connection

  const size_t capacity = JSON_OBJECT_SIZE(4) + 70; // simulate your JSON data https://arduinojson.org/v6/assistant/
  DynamicJsonDocument doc(capacity);

  // Deserialize the JSON document
  DeserializationError error = deserializeJson(doc, payload);

  // Test if parsing succeeds.
  if (error) {
    Serial.print(F("deserializeJson() failed: "));
    Serial.println(error.c_str());
    return;
  }

  const char* waktu_res = doc["waktu"];
  String nama_res = doc["nama"];
  const char* uid_res = doc["uid"];
  String status_res = doc["status"];

  String first_name;
  for (int i = 0; i < nama_res.length(); i++) {
    if (nama_res.charAt(i) == ' ') {
      first_name = nama_res.substring(0, i);
      break;
    }
  }

  display.clearDisplay();
  display.drawBitmap(0, 5, userBitmap, 50, 60, WHITE);
  display.setTextColor(WHITE);
  display.setTextSize(1);

  // Print Data
  if (status_res == "INVALID") {
    display.setCursor(52, 15); display.print("Who are you?");
    display.setCursor(52, 30); display.print(uid_res);
    display.setCursor(52, 40); display.print(status_res);
  } else {
    if (status_res == "IN") {
      display.setCursor(52, 15); display.print("Welcome!");
      digitalWrite(RELAY_PIN, HIGH);
      delay(1000);
    } else {
      display.setCursor(52, 15); display.print("See you!");
      digitalWrite(RELAY_PIN, HIGH);
      delay(1000);
    }
    display.setCursor(52, 30); display.print(first_name);
    display.setCursor(52, 40); display.print(waktu_res);
  }
  display.display();
  delay(3000);

  digitalWrite(RELAY_PIN, LOW);
}

void ConnectWIFI() {
  Serial.print("Attempting to connect to SSID: ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  int i = 0;
  int a = 0;
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    display.clearDisplay();
    display.setTextSize(1);
    if (a == 0) {
      display.drawBitmap(52, 20, wifi_icon, 16, 16, WHITE);
      a = 1;
    } else {
      display.drawBitmap(52, 20, wifi_icon, 16, 16, BLACK);
      a = 0;
    }
    display.setCursor(25, 50); display.print("Connecting ...");
    display.display();
    delay(1000);
    ++i;
    if (i == 30) {
      i = 0;
      Serial.println("\nFailed to Connect.");
      break;
    }
  }
  Serial.println("\nConnected!");
  display.clearDisplay();
  display.setTextSize(1);
  display.drawBitmap(52, 20, wifi_icon, 16, 16, WHITE);
  display.setCursor(33, 50); display.print("Connected!");
  display.display();
  delay(2000);
}

void ShowReaderDetails() {
  // Get the MFRC522 software version
  byte v = mfrc522.PCD_ReadRegister(mfrc522.VersionReg);
  Serial.print(F("MFRC522 Software Version: 0x"));
  Serial.print(v, HEX);
  if (v == 0x91)
    Serial.print(F(" = v1.0"));
  else if (v == 0x92)
    Serial.print(F(" = v2.0"));
  else
    Serial.print(F(" (unknown), probably a Chinese clone?"));
  Serial.println("");
  // When 0x00 or 0xFF is returned, communication probably failed
  if ((v == 0x00) || (v == 0xFF)) {
    Serial.println(F("WARNING: Communication failure, is the MFRC522 properly connected?"));
    Serial.println(F("SYSTEM HALTED: Check connections."));
    while (true); // do not go further
  }
}
