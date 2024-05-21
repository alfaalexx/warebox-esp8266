#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <ArduinoJson.h>
#include "icon.h"

// OLED initialization
#define SCREEN_WIDTH 128 
#define SCREEN_HEIGHT 64   
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire);

#define RST_PIN         16          
#define SS_PIN          0
byte buzzer = 2; //pin D0
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance

const char* ssid = "gratiss";    // Your Wifi SSID
const char* password = "helloworld";   // Wifi Password
String server_addr = "192.168.43.152:8080";  // Your server address or computer IP

byte readCard[4];   
uint8_t successRead;    
String UIDCard;

// Deklarasi relay pin di sini agar bisa diakses di seluruh program
int relayPin = D4; // Change to the appropriate pin connected to the relay

void setup() {
  pinMode(buzzer, OUTPUT);
  pinMode(relayPin, OUTPUT); // Definisikan pin relay sebagai OUTPUT
  digitalWrite(buzzer, HIGH); // Cobalah mengatur buzzer ke ON
  delay(500); // Tunggu sebentar
  digitalWrite(buzzer, LOW); // Matikan buzzer
  digitalWrite(relayPin, LOW);
  Serial.begin(115200);                                         // Initialize serial communications with the PC
  SPI.begin();                                                  // Init SPI bus
  mfrc522.PCD_Init();                                           // Init MFRC522 card
  Serial.println(F("Read Uid data on a MIFARE PICC:"));    // Shows in serial that it is ready to read
  ShowReaderDetails();                                          // Show details of PCD - MFRC522 Card Reader details
  
  if (!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) { 
    Serial.println(F("SSD1306 allocation failed"));
    for(;;); 
  }
  
  // Just intro
  display.clearDisplay();
  display.setTextColor(WHITE);
  display.setTextSize(1);
  display.setCursor(38, 20); display.println(F("WareBox"));
  display.setCursor(35, 35); display.println(F("Locker Digital"));
  display.display();
  delay(1000); 
  ConnectWIFI(); 
  delay(2000);
}

void loop() { 
  display.clearDisplay(); 
  display.drawBitmap(32, 0, cardBitmap, 68, 50, WHITE);
  display.setTextSize(1);
  display.setCursor(30, 55); display.print("Tap Your Card!");
  display.display();
  successRead = getID();
}

uint8_t getID() {
  // Getting ready for Reading PICCs
  if (!mfrc522.PICC_IsNewCardPresent()) { 
    return 0;
  }
  if (!mfrc522.PICC_ReadCardSerial()) {   
    return 0;
  }
  UIDCard = "";
  Serial.println(F("Scanned PICC's UID:"));
   
  for (uint8_t i = 0; i < mfrc522.uid.size; i++) {  
    UIDCard += String(mfrc522.uid.uidByte[i], HEX);
  }
  UIDCard.toUpperCase(); // Capitalize
  Serial.print("UID:");
  Serial.println(UIDCard);
  Serial.println(F("**End Reading**"));
  digitalWrite(buzzer, HIGH); delay(200);
  digitalWrite(buzzer, LOW); delay(200);
  digitalWrite(buzzer, HIGH); delay(200);
  digitalWrite(buzzer, LOW);
  
  storeData(); // Store data to DB
  delay(2000); 
  
  mfrc522.PICC_HaltA(); // Stop reading
  return 1;
}

void storeData() {
  ConnectWIFI(); // Check Wi-Fi connection
  WiFiClient client;
  String address, message, first_name;
  
  // Equate with your Server address (computer's IP address) and your directory application
  address = "http://" + server_addr + "/warebox/webapi/api/create.php?uid=" + UIDCard;
  
  HTTPClient http;  
  http.begin(client, address);
  int httpCode = http.GET();        // Send the GET request
  String payload; 
  Serial.print("Response: "); 
  if (httpCode > 0) {               // Check the returning code    
      payload = http.getString();   // Get the request response payload
      payload.trim();               // Remove \n character
      if (payload.length() > 0) {
         Serial.println(payload + "\n");
      } else {
         Serial.println("Empty response");
      }
  } else {
      Serial.printf("HTTP GET failed, error: %s\n", http.errorToString(httpCode).c_str());
  }
  http.end();   // Close connection  

  if (payload.length() == 0) {
    Serial.println(F("Received empty payload"));
    return;
  }

  const size_t capacity = JSON_OBJECT_SIZE(4) + 70; // Simulate your JSON data https://arduinojson.org/v6/assistant/
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

  // Check status and control relay accordingly
  if (status_res == "IN") {
    digitalWrite(relayPin, HIGH); // Activate relay
    delay(5000); // Delay 5 detik
    digitalWrite(relayPin, LOW); // Deactivate relay
  }

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
    message = "Who are you?";
    display.setCursor(52, 15); display.print(message);
    display.setCursor(52, 30); display.print(uid_res);
    display.setCursor(52, 40); display.print(status_res);
  } else {
    if (status_res == "IN") {
      message = "Welcome!";
    } else {
      message = "See you!";
    }
    display.setCursor(52, 15); display.print(message);
    display.setCursor(52, 30); display.print(first_name);
    display.setCursor(52, 40); display.print(waktu_res);
  }
  display.display();
  delay(3000);
}

void ConnectWIFI() {
  if (WiFi.status() != WL_CONNECTED) {
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
        display.clearDisplay(); 
        display.setTextSize(1);
        display.drawBitmap(52, 20, wifi_icon, 16, 16, BLACK);
        display.setCursor(25, 50); display.print("Failed to Connect");
        display.display();
        delay(2000);
        break;
      }    
    }
    if (WiFi.status() == WL_CONNECTED) {
      Serial.println("\nConnected!"); 
      display.clearDisplay(); 
      display.setTextSize(1);
      display.drawBitmap(52, 20, wifi_icon, 16, 16, WHITE);
      display.setCursor(33, 50); display.print("Connected!");
      display.display();
      delay(2000);
    }
  }
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
    while (true); // Do not go further
  }
}
