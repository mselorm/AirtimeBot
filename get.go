<<<<<<< HEAD
/**
   BasicHTTPClient.ino

    Created on: 24.05.2015

*/

#include <Arduino.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>

ESP8266WiFiMulti WiFiMulti;

String get_numbers();
void _phonenum();
#define LED D0

bool isConnected = false;

String url = "http://tuatuagye.com/airtimeBot/airtimebot.php?True=hi";

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
        {     //uncomment this line to troubleshoot the error Isaac
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


void _phonenum(){
    //here i take the phone numbers to the sim800l
        
        String phones = "";
        Serial.println("the payload");
            Serial.println(get_numbers());
           phones = get_numbers();
           Serial.println(phones);
/*
         d =  phones.indexOf(dick);
           Serial.println(d);

           phones.substring(d)

           
*/
}
=======
/********************************************************************************
 * Example of HTTPS GET with SoftwareSerial and Arduino-SIM800L-driver          *
 *                                                                              *
 * Author: Olivier Staquet                                                      *
 * Last version available on https://github.com/ostaquet/Arduino-SIM800L-driver *
 ********************************************************************************
 * MIT License
 *
 * Copyright (c) 2019 Olivier Staquet
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *******************************************************************************/
#include <SoftwareSerial.h>

#include "SIM800L.h"
//SoftwareSerial mySerial(8, 7); // RX, TX
#define SIM800_TX_PIN 8
#define SIM800_RX_PIN 7
#define SIM800_RST_PIN 6

const char APN[] = "web.tigo.com.gh";
const char URL[] = "https://postman-echo.com/get?foo1=bar1&foo2=bar2";

SIM800L *sim800l;

void setup()
{
    // Initialize Serial Monitor for debugging
    Serial.begin(115200);
    while (!Serial)
        ;

    // Initialize a SoftwareSerial
    SoftwareSerial *serial = new SoftwareSerial(SIM800_TX_PIN, SIM800_RX_PIN);
    serial->begin(9600);
    delay(1000);

    // Initialize SIM800L driver with an internal buffer of 200 bytes and a reception buffer of 512 bytes, debug disabled
    sim800l = new SIM800L((Stream *)serial, SIM800_RST_PIN, 200, 512);

    // Equivalent line with the debug enabled on the Serial
    //sim800l = new SIM800L((Stream *)serial, SIM800_RST_PIN, 200, 512, (Stream *)&Serial);

    // Setup module for GPRS communication
    setupModule();
}

void loop()
{
    // Establish GPRS connectivity (5 trials)
    bool connected = false;
    for (uint8_t i = 0; i < 5 && !connected; i++)
    {
        delay(1000);
        connected = sim800l->connectGPRS();
    }

    // Check if connected, if not reset the module and setup the config again
    if (connected)
    {
        Serial.println(F("GPRS connected !"));
    }
    else
    {
        Serial.println(F("GPRS not connected !"));
        Serial.println(F("Reset the module."));
        sim800l->reset();
        setupModule();
        return;
    }

    Serial.println(F("Start HTTP GET..."));

    // Do HTTP GET communication with 10s for the timeout (read)
    uint16_t rc = sim800l->doGet(URL, 10000);
    if (rc == 200)
    {
        // Success, output the data received on the serial
        Serial.print(F("HTTP GET successful ("));
        Serial.print(sim800l->getDataSizeReceived());
        Serial.println(F(" bytes)"));
        Serial.print(F("Received : "));
        Serial.println(sim800l->getDataReceived());
    }
    else
    {
        // Failed...
        Serial.print(F("HTTP GET error "));
        Serial.println(rc);
    }

    // Close GPRS connectivity (5 trials)
    bool disconnected = sim800l->disconnectGPRS();
    for (uint8_t i = 0; i < 5 && !connected; i++)
    {
        delay(1000);
        disconnected = sim800l->disconnectGPRS();
    }

    if (disconnected)
    {
        Serial.println(F("GPRS disconnected !"));
    }
    else
    {
        Serial.println(F("GPRS still connected !"));
    }

    // Go into low power mode
    bool lowPowerMode = sim800l->setPowerMode(MINIMUM);
    if (lowPowerMode)
    {
        Serial.println(F("Module in low power mode"));
    }
    else
    {
        Serial.println(F("Failed to switch module to low power mode"));
    }

    // End of program... wait...
    while (1)
        ;
}

void setupModule()
{
    // Wait until the module is ready to accept AT commands
    while (!sim800l->isReady())
    {
        Serial.println(F("Problem to initialize AT command, retry in 1 sec"));
        delay(1000);
    }
    Serial.println(F("Setup Complete!"));

    // Wait for the GSM signal
    uint8_t signal = sim800l->getSignal();
    while (signal <= 0)
    {
        delay(1000);
        signal = sim800l->getSignal();
    }
    Serial.print(F("Signal OK (strenght: "));
    Serial.print(signal);
    Serial.println(F(")"));
    delay(1000);

    // Wait for operator network registration (national or roaming network)
    NetworkRegistration network = sim800l->getRegistrationStatus();
    while (network != REGISTERED_HOME && network != REGISTERED_ROAMING)
    {
        delay(1000);
        network = sim800l->getRegistrationStatus();
    }
    Serial.println(F("Network registration OK"));
    delay(1000);

    // Setup APN for GPRS configuration
    bool success = sim800l->setupGPRS(APN);
    while (!success)
    {
        success = sim800l->setupGPRS(APN);
        delay(5000);
    }
    Serial.println(F("GPRS config OK"));
}


/************************************************************************************/

int wait = 2000;
String gsmData;

mySerial.println("AT+CFUN=1");
delay(10000);
while (mySerial.available())
{
    gsmData += (mySerial.read());
}
mySerial.println("AT+CMEE=2");
delay(wait);
while (mySerial.available())
{
    gsmData += (mySerial.read());
}

mySerial.println("AT+CGATT=1");
delay(wait + 8000);
while (mySerial.available())
{
    gsmData += (mySerial.read());
}

delay(wait);

mySerial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
delay(wait);
while (mySerial.available())
{
    gsmData += (mySerial.read());
}

mySerial.println("AT+SAPBR=3,1,\"APN\",\"internet\"");
delay(wait);
while (mySerial.available())
{
    gsmData += (mySerial.read());
}

mySerial.println("AT+SAPBR=1,1");
delay(10000);
while (mySerial.available())
{
    gsmData += (mySerial.read());
}
mySerial.println("AT+SAPBR=2,1");
delay(10000);

while (mySerial.available())
{
    gsmConnData += (mySerial.read());
}
if ((gsmConnData.indexOf("0,0,0,0") > 0) || (gsmConnData.indexOf("ERROR") > 0))
{
    //no internet connection
    return false;
}
else
    return true;

//Serial.println(gsmData)  for troublshooting
}
String gsmHttpData_ = "";
server_message = message;
id_value = value;

mySerial.println("AT+HTTPINIT");
delay(wait);
while (mySerial.available())
{
    gsmHttpData += (mySerial.read());
}

//mySerial.print(("AT+HTTPPARA=\"URL\",\"http://ratty53iadu.000webhostapp.com/smartbin_talk.php?" + value + "="));
mySerial.print(("AT+HTTPPARA=\"URL\",\"http://tuatuagye.com/smartbin_talk.php?" + value + "="));
mySerial.print(server_message);
mySerial.println("\"");
delay(wait);
while (mySerial.available())
{
    gsmHttpData += (mySerial.read());
}

mySerial.println("AT+HTTPACTION=0");
delay(wait);
while (mySerial.available())
{
    gsmHttpData_ += (mySerial.read());
}

mySerial.println("AT+HTTPTERM");
delay(wait);
while (mySerial.available())
{
    gsmHttpData += (mySerial.read());
}

if (gsmHttpData_.indexOf("OK") > 0)
{
    return true;
}
else
    return false;

mySerial.println("AT+CFUN=0");
delay(10000);
while (mySerial.available())
{
    gsmHttpData += (mySerial.read());
}

//uncomment this line to debug
Serial.println(gsmHttpData) // for troublshooting
}
>>>>>>> 056a9d5f86f59554f05861e37cffa5eecbb1c8ee
