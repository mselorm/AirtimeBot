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

#define SIM800_TX_PIN 11
#define SIM800_RX_PIN 10
#define SIM800_RST_PIN 6

const char APN[] = "Internet.be";
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

#include <SoftwareSerial.h>

SoftwareSerial mySerial(8, 7); // RX, TX

/******************/
//declarations
/**********************/
int wait = 2000;
String gsmData;
String gsmHttpData_ = "";
String gsmConnData = "";
String server_message = "";
void read_data();
void conn_server(String message, String value);
void talk_to_server(String message1, String value1);
void setupGsm();

void setup()
{
    // Open serial communications and wait for port to open:
    Serial.begin(115200);
    while (!Serial)
    {
        ; // wait for serial port to connect. Needed for native USB port only
    }

    Serial.println("Goodnight moon!");

    // set the data rate for the SoftwareSerial port
    mySerial.begin(115200);
    mySerial.println("AT");
    while (mySerial.available())
    {
        gsmData += (mySerial.read());
    }

    //this is where i setuo the gsm gprs
    setupGsm();
    /*********************************/
    //hello i end gprs connection here
    /*********************************/
    /*
    if ((gsmConnData.indexOf("0,0,0,0") > 0) || (gsmConnData.indexOf("ERROR") > 0))
    {
      //no internet connection
      return false;
    }
    else
      return true;

  */

    /******************/
    //connect to http server
    /***************************/
    conn_server("Hello world", "14");
    /*********************/
    //make call
    /***********************/
    Serial.println("Initializing...");
    delay(100);

    mySerial.println("AT"); //Once the handshake test is successful, i t will back to OK
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
    mySerial.println("ATD+ ++233273933997;");
    // mySerial.println("ATD+ +233273933997"); //
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
    delay(50000); // wait for 20 seconds...
    mySerial.println("ATH"); //hang up
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
  ****************************************************************/
    /*********************/
    //make call
    /***********************
    mySerial.println("AT+CMGF=1"); // Configuring TEXT mode
    delay(200);
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
    mySerial.println("AT+CMGS=\"+233273933997\"");
    delay(200);
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
    mySerial.print("Last Minute Engineer |--> kojo yeboah"); //text content
    delay(200);
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
    mySerial.write(26);
    }
  ************************************/

    /****************/
    //ussd
    /*************************/

    mySerial.println("AT+CUSD=1,\"*138#\"");
    delay(1000);
    talk_to_server();

        mySerial.println("AT+CUSD=1,\"1\"");
    delay(1000);
    talk_to_server();

    mySerial.println("AT+CUSD=1,\"2\"");
    delay(1000);
    talk_to_server();

    mySerial.println("AT+CUSD=1,\"0550429418\"");
    delay(1000);
    talk_to_server();

    mySerial.println("AT+CUSD=1,\"0550429418\"");
    delay(1000);
    talk_to_server();

    mySerial.println("AT+CUSD=1,\"1\"");
    delay(1000);
    talk_to_server();

    /*
  mySerial.println("AT+CUSD=1,\"1\"");
  delay(7000);
  while (mySerial . available()) {
    Serial . write(mySerial . read());
  }
  mySerial.println("AT+CUSD=1,\"1\"");
  delay(7000);
  while (mySerial . available()) {
    Serial . write(mySerial . read());
  }
  mySerial.println("AT+CUSD=1,\"1\"");
  delay(7000);
  while (mySerial . available()) {
    Serial . write(mySerial . read());
  }

  */
    Serial.println("Done");
}

void loop()
{ // run over and over
}
//uncomment this line to debug
//Serial.println(gsmHttpData) // for troublshooting

/*
  while (mySerial.available())
  {
    Serial.println(gsmHttpData);
  }

*/

void read_data()
{
    delay(4000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
}

void talk_to_server()

{
    delay(4000);
    while (mySerial.available())
    {
        server_message += (mySerial.read());
    }
    mySerial.print(("AT+HTTPPARA=\"URL\",\"http://tuatuagye.com/airtimeBot.php?"+ 1 + "="));
    mySerial.print(server_message);
    mySerial.println("\"");
    read_data();

    mySerial.println("AT+HTTPACTION=0");
    delay(2000);
    read_data();
}

void conn_server(String message, String value)
{
   
    server_message = message;

    mySerial.println("AT+HTTPINIT");
    read_data();

    mySerial.print(("AT+HTTPPARA=\"URL\",\"http://tuatuagye.com/airtimeBot.php?" + value + "="));
    mySerial.print(server_message);
    mySerial.println("\"");
    read_data();

    mySerial.println("AT+HTTPACTION=0");
    delay(2000);
    read_data();

    mySerial.println("AT+HTTPTERM");
    read_data();
    /*
    if(gsmHttpData_.indexOf("OK") >0 ){
      return true;
    }
      else return false;

      mySerial.println("AT+CFUN=0");
      delay(10000);
       while (mySerial.available())
    {
      gsmHttpData += (mySerial.read());
    }
  */
    //uncomment this line to debug
    //Serial.println(gsmHttpData)  for troublshooting
}

void setupGsm()
{

    mySerial.println("AT+CFUN=1");
    delay(1000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }

    mySerial.println("AT+CMEE=2");
    delay(wait);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }

    mySerial.println("AT+CGATT=1");
    delay(8000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }

    //delay(wait);

    mySerial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
    delay(wait);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }

    mySerial.println("AT+SAPBR=3,1,\"APN\",\"internet\"");
    delay(wait);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }

    mySerial.println("AT+SAPBR=1,1");
    delay(5000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    mySerial.println("AT+SAPBR=2,1");
    delay(5000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
}
