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
void talk_to_server();
void readServerResponse();
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
    mySerial.begin(4800);
    mySerial.println("AT");
    while (mySerial.available())
    {
        gsmData += (mySerial.read());
    }

    /*********************/
    //make call
    /***********************
    Serial.println("make first call...");
    delay(100);

    mySerial.println("AT"); //Once the handshake test is successful, i t will back to OK
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
    mySerial.println("ATD+ ++233209455482;");
    // mySerial.println("ATD+ +233273933997"); //
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
    delay(10000); // wait for 10 seconds...
    mySerial.println("ATH"); //hang up
    while (mySerial.available())
    {
    Serial.write(mySerial.read());
    }
  /****************************************************************/

    //this is where i setuo the gsm gprs
    Serial.println("Setting up gprs con.....!");
   // setupGsm();
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

    Serial.println("Try first connection...!");
    /******************/
    //connect to http server
    /***************************/
    conn_server("Hello world", "14");

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

    // initiate server comm
    /************************************/
   

    /*
  /****************/
    //ussd
    /*************************
   mySerial.println("AT+CUSD=1,\"*138#\"");
    delay(1000);
     while (mySerial.available()) {
    Serial.write(mySerial . read());
  }
    talk_to_server();

        mySerial.println("AT+CUSD=1,\"1\"");
    delay(1000);
     while (mySerial.available()) {
    Serial.write(mySerial . read());
  }
    talk_to_server();

    mySerial.println("AT+CUSD=1,\"2\"");
     while (mySerial.available()) {
    Serial.write(mySerial . read());
  }
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
*********************************************************************************************************************************************************/
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
    Serial.println("Getting ready to read data from server............!");
    delay(2000);
}

void loop()
{
    // run over and over
    delay(2000);
    readServerResponse();
    delay(2000);
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

void readServerResponse()
{
    mySerial.println("AT+HTTPINIT");
    read_data();
    mySerial.print(("AT+HTTPPARA=\"URL\",\"http://tuatuagye.com/airtimeBot/airtimebot.php"));
    delay(1000);
    mySerial.print("server_message");
    mySerial.println("\"");
    while (mySerial.available())
    {
        Serial.write(mySerial.read());
    }
    mySerial.println("AT+HTTPACTION=0");
    delay(2000);
    read_data();
    mySerial.println("AT+HTTPREAD");
    //delay(7000);
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
        server_message += mySerial.read();
    }
    mySerial.print(("AT+HTTPPARA=\"URL\",\"http://tuatuagye.com/airtimeBot/airtimebot.php?"));
    mySerial.print(server_message);
    mySerial.println("\"");
    read_data();

    mySerial.println("AT+HTTPACTION=0");
    delay(2000);
    read_data();
}
void conn_server(String message, String value)
{
    String gsmHttpData_ = "";
    server_message = message;

    mySerial.println("AT+HTTPINIT");
    read_data();

    mySerial.print(("AT+HTTPPARA=\"URL\",\"http://tuatuagye.com/vehicle_tracker.php?" + value + "="));
    mySerial.print(server_message);
    mySerial.println("\"");
    read_data();
    /************mySerial.print(("AT+HTTPDATA=5,50000"));**************/
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

    mySerial.println("AT+CREG?");
    delay(8000);
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
}