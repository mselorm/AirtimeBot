/**
   BasicHTTPClient.ino

    Created on: 24.05.2015

*/

#include <Arduino.h>

#include "StringSplitter.h"
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>

ESP8266WiFiMulti WiFiMulti;

String get_numbers();
void _phonenum();
#define LED D0

bool isConnected = false;

String url = "http://brichghana.com/app.bvs.airtimebot/airtimeBot/airtimebot.php?True=hi";

void setup()
{

    Serial.begin(115200);
    // Serial.setDebugOutput(true);
    delay(1000);
    pinMode(LED, OUTPUT);
    Serial.println();
    Serial.println();
    Serial.println();

    //establish connection with wifi
    for (uint8_t t = 4; t > 0; t--)
    {
        Serial.printf("[SETUP] WAIT %d...\n", t);
        Serial.flush();
        delay(500);
    }

    WiFi.mode(WIFI_STA);
    WiFiMulti.addAP("BRICH COMPANY LTD", "brichonline000");
    if ((WiFiMulti.run() == WL_CONNECTED))
    {

        isConnected = true;
        //  get_numbers();
    }

    _phonenum();
}

void loop()
{
    // wait for WiFi connection

    digitalWrite(LED, HIGH); // turn the LED off.(Note that LOW is the voltage level but actually
                             //the LED is on; this is because it is acive low on the ESP8266.
    delay(400);              // wait for 1 second.
    digitalWrite(LED, LOW);  // turn the LED on.
    delay(400);              // wait for 1 second
}

String get_numbers()
{

    //Serial.println("the function is called");
    WiFiClient client;

    HTTPClient http;

    // Serial.print("[HTTP] begin...\n");
    if (http.begin(client, url))
    { // HTTP

        //   Serial.print("[HTTP] GET...\n");
        // start connection and send HTTP header
        int httpCode = http.GET();

        // httpCode will be negative on error
        if (httpCode > 0)
        {
            // HTTP header has been send and Server response header has been handled
            // Serial.printf("[HTTP] GET... code: %d\n", httpCode);

            // file found at server
            if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY)
            {
                String payload = http.getString();
                // Serial.println(payload);
                return payload;
            }
        }
        else
        { //uncomment this line to troubleshoot the error Isaac
            //Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
            return "error_url";
        }

        http.end();
    }
    else
    {
        Serial.printf("[HTTP} Unable to connect\n");
    }
}

void _phonenum()
{
    //here i take the phone numbers to the sim800l

    String phones = "";
    Serial.println("the payload");
    Serial.println(get_numbers());
    phones = get_numbers();
    Serial.println(phones);

    Serial.println("i've been fair");

    //  String strTest = "123,456,789,abc";
    Serial.println("Test String: " + phones);

    StringSplitter *splitter = new StringSplitter(phones, ',', 8); // new StringSplitter(string_to_split, delimiter, limit)
    int itemCount = splitter->getItemCount();
   Serial.println("Item count: " + String(itemCount));

    for (int i = 0; i < 8; i++)
    {
        String item = splitter->getItemAtIndex(i);
        Serial.println("Item @ index " + String(i) + ": " + String(item));
    }
    /*
         d =  phones.indexOf(dick);
           Serial.println(d);

           phones.substring(d)
*/
}