#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ArduinoJson.h>

// inisialisasi pin untuk RFID
#define RST_PIN 22
#define SS_PIN 21
byte buzzer = 2; // pin GPIO2
MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance

const char* ssid = "gratiss"; // Your Wifi SSID
const char* password = "helloworld"; // Wifi Password
String server_addr = "192.168.43.152:8080"; // your server address or computer IP

byte readCard[4];
uint8_t successRead;
String UIDCard;

void setup() {
  pinMode(buzzer, OUTPUT);
  Serial.begin(115200); // Initialize serial communications with the PC
  SPI.begin(); // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522 card
  Serial.println(F("Read Uid data on a MIFARE PICC:")); // shows in serial that it is ready to read
  ShowReaderDetails(); // Show details of PCD - MFRC522 Card Reader details
  
  ConnectWIFI();
}

void loop() {
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
  UIDCard.toUpperCase(); // Capital
  Serial.print("UID:");
  Serial.println(UIDCard);
  Serial.println(F("**End Reading**"));
  digitalWrite(buzzer, HIGH); delay(200);
  digitalWrite(buzzer, LOW); delay(200);
  digitalWrite(buzzer, HIGH); delay(200);
  digitalWrite(buzzer, LOW);

  storeData(); // store data to DB
  delay(2000);

  mfrc522.PICC_HaltA(); // Stop reading
  return 1;
}

void storeData() {
  ConnectWIFI(); // check wifi connection
  WiFiClient client;
  String address;

  // equate with your Server address (computer's IP address) and your directory application
  address = "http://" + server_addr + "/warebox/webapi/api/create.php?uid=" + UIDCard;

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

  // Print Data to Serial Monitor
  if (status_res == "INVALID") {
    Serial.println("Who are you?");
    Serial.println(uid_res);
    Serial.println(status_res);
  } else {
    if (status_res == "IN") {
      Serial.println("Welcome!");
    } else {
      Serial.println("See you!");
    }
    Serial.println(first_name);
    Serial.println(waktu_res);
  }
}

void ConnectWIFI() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.print("Attempting to connect to SSID: ");
    Serial.println(ssid);
    WiFi.begin(ssid, password);
    int i = 0;
    while (WiFi.status() != WL_CONNECTED) {
      Serial.print(".");
      delay(1000);
      ++i;
      if (i == 30) {
        i = 0;
        Serial.println("\n Failed to Connect.");
        break;
      }
    }
    if (WiFi.status() == WL_CONNECTED) {
      Serial.println("\n Connected!");
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
    while (true); // do not go further
  }
}
