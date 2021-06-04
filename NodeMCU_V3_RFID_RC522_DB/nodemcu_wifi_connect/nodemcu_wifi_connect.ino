#include <BearSSLHelpers.h>
#include <CertStoreBearSSL.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiAP.h>
#include <ESP8266WiFiGeneric.h>
#include <ESP8266WiFiGratuitous.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266WiFiScan.h>
#include <ESP8266WiFiSTA.h>
#include <ESP8266WiFiType.h>
#include <WiFiClient.h>
#include <WiFiClientSecure.h>
#include <WiFiClientSecureAxTLS.h>
#include <WiFiClientSecureBearSSL.h>
#include <WiFiServer.h>
#include <WiFiServerSecure.h>
#include <WiFiServerSecureAxTLS.h>
#include <WiFiServerSecureBearSSL.h>
#include <WiFiUdp.h>


const char* ssid = "CatalinaHenao";
const char* password = "437013930078";
int ledPin = 2; // Arduino standard is GPIO13 but lolin nodeMCU is 2 http://www.esp8266.com/viewtopic.php?f=26&t=13410#p61332
WiFiServer server(80);
void setup() {
 Serial.begin(115200);
 delay(10);
pinMode(ledPin, OUTPUT);
digitalWrite(ledPin, HIGH);
// Connect to WiFi network
Serial.println();
Serial.println();
 Serial.print("Conectado a");
 Serial.println(ssid);

WiFi.begin(ssid, password);

while (WiFi.status() != WL_CONNECTED) {
 delay(500);
 Serial.print(".");
 }
 Serial.println("");
 Serial.println("WiFi Conectado");

// Start the server
 server.begin();
 Serial.println("El servidor comenzó");

// Print the IP address
 Serial.print("Utilice esta URL para conectar:");
 Serial.print("http://");
 Serial.print(WiFi.localIP());
 Serial.println("/");

}

void loop() {
 // Check if a client has connected
 WiFiClient client = server.available();
 if (!client) {
 return;
 }

// Wait until the client sends some data
 Serial.println("new client");
 while(!client.available()){
 delay(1);
 }

// Read the first line of the request
 String request = client.readStringUntil('r');
 Serial.println(request);
 client.flush();

// Match the request
 //Lolin nodeMCU has inverted the LED.
 //Low level turns on the led
 //while High level turns it off

int value = HIGH; //initially off
 if (request.indexOf("/LED=OFF") != -1) {
 digitalWrite(ledPin, HIGH);
 value = HIGH;
 }
 if (request.indexOf("/LED=ON") != -1) {
 digitalWrite(ledPin, LOW);
 value = LOW;
 }

// Set ledPin according to the request
 //digitalWrite(ledPin, value);

// Return the response
 client.println("HTTP/1.1 200 OK");
 client.println("Content-Type: text/html");
 client.println(""); 
 client.println("<!DOCTYPE HTML>");
 client.println("<html>");

client.print("Led pin is now: ");
 //High=off
 //Low=on

if(value == HIGH) {
 client.print("Off");
 } else {
 client.print("On");
 }
 client.println("<br><br>");
 client.println("<a href=\"/LED=ON\"\"><button>Turn On </button></a>");
 client.println("<a href=\"/LED=OFF\"\"><button>Turn Off </button></a><br />");
 client.println("</html>");

delay(1);
 Serial.println("Client disonnected");
 Serial.println("");
}
