#include <SoftwareSerial.h>
#include <Arduino.h>

#include "StringSplitter.h"

SoftwareSerial mySerial(8, 7); // RX, TX

/******************/
//declarations
/**********************/
int ussd = 3700;
String gsmData;
String gsmHData_ = "";
String gsmConnData = "";
String server_message = "";
String phonenumber[6];
void read_data();
void conn_server(String message, String value);
void setupGsm();
void sendtext();
void makecall();

/******************/
//program begins here
/**********************/
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
    mySerial.begin(4800);
    mySerial.println("AT");
    while (mySerial.available())
    {
        gsmData += (mySerial.read());
    }

    //this is where i setuo the gsm gprs
    setupGsm();
    // send_data("0542235971");
}

void loop()
{ // run over and over

    if (Serial.available())
    {
        gsmConnData = Serial.readString();

        phonenumber[0] = "";
        phonenumber[1] = "";
        phonenumber[2] = "";
        phonenumber[3] = "";
        phonenumber[4] = "";
        phonenumber[5] = "";
        StringSplitter *splitter = new StringSplitter(gsmConnData, ',', 5); // new StringSplitter(string_to_split, delimiter, limit)

        for (int i = 0; i < 5; i++)
        {
            String item = splitter->getItemAtIndex(i);
            //  Serial.println("Item @ index " + String(i) + ": " + String(item));
            phonenumber[i] = splitter->getItemAtIndex(i);
            ;
        }
        Serial.println(phonenumber[0]);
        Serial.println(phonenumber[1]);
        Serial.println(phonenumber[2]);
        Serial.println(phonenumber[3]);
        Serial.print(phonenumber[4]);
        phonenumber[0].trim();
        phonenumber[1].trim();
        phonenumber[2].trim();
        phonenumber[3].trim();
        phonenumber[4].trim();
        phonenumber[5] = "1111111111";

        for (int i = 1; i < 5; i++)
        {
            //send airtime to five numbers
            send_data(phonenumber[i], phonenumber[0]);
            delay(2000);

            /*************************************************************************************************************/
            //this is put in to break the ussd sequence in test mode, it should be commented out in production//
            /*************************************************************************************************************/
            mySerial.println("AT");
            delay(1000);
            while (mySerial.available())
            {
                Serial.write(mySerial.read());
            }
            dump_data(phonenumber[5], phonenumber[0]);
        }
    }
}

void read_data()
{
    delay(1000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
}

void read_string()
{
    char *result = "";
    //gsmHData_ += "...";
    delay(1000);
    while (mySerial.available())
    {
        result += mySerial.read();
    }
    Serial.println(result);
}

/****************/
//ussd
/*************************/
void send_data(String phone, String number)
{

    mySerial.println("AT");
    delay(1000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    mySerial.println("AT+CUSD=1,\"*138#\"");
    delay(ussd);
    read_data();

    mySerial.println("AT+CUSD=1,\"1\"");
    delay(ussd);
    while (mySerial.available())
        read_data();
    mySerial.println("AT+CUSD=1,\"2\"");
    delay(ussd);
    read_data();

    mySerial.print("AT+CUSD=1,\"");
    mySerial.print(phone);
    mySerial.println("\"\r");
    delay(ussd);
    read_data();
    mySerial.print("AT+CUSD=1,\"");
    mySerial.print(phone);
    mySerial.println("\"\r");
    delay(ussd);
    read_data();
    mySerial.println("AT+CUSD=1,\"1\"");
    delay(ussd);
    read_data();

    mySerial.print("AT+CUSD=1,\"");
    mySerial.print(number);
    mySerial.println("\"\r");
    delay(ussd);

    mySerial.println("AT+CUSD=1,\"1\"");
    delay(ussd);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    mySerial.println("AT+CUSD=1,\"1\"");
    delay(ussd);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    mySerial.println("AT+CUSD=1,\"1\"");
    delay(ussd);
    while (mySerial.available()) {
        Serial.write(mySerial.read());
    }

    //Serial.println(gsmHData);
}

void dump_data(String phone, String number)
{

    mySerial.println("AT");
    delay(1000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    mySerial.println("AT");
    delay(2000);
    while (mySerial.available()) {
        Serial.write(mySerial.read());
    }
  
    mySerial.println("AT+CUSD=1,\"*124#\"");
    delay(ussd);
    read_data();

    mySerial.println("AT+CUSD=1,\"1\"");
    delay(ussd);
    while (mySerial.available())
        read_data();
  /*  mySerial.println("AT+CUSD=1,\"2\"");
    delay(ussd);
    read_data();
    */
}
void conn_server(String message, String value)
{
    //yeah  i didn't use it cus of the nodemcu
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
    delay(2000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    /*
    mySerial.println("AT+CGATT=1");
    delay(8000);
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
*/
    //delay(wait);
    //this code works perfectly i commented it out cuz i had the nodemcu to push response to server
    /*
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
    delay(10000);
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
    */
}

/*********************/
//make call
/***********************/
void makecall()
{
    Serial.println("Initializing...");
    delay(100);

    mySerial.println("AT"); //Once the handshake test is successful, i t will back to OK
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    mySerial.println("ATD+ +233209455482;");
    // mySerial.println("ATD+ +233273933997"); //
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    delay(50000);            // wait for 20 seconds...
    mySerial.println("ATH"); //hang up
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
}
/****************************************************************/
/*********************/
//send text message
/***********************/
void sendtext()
{
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

/************************************/
