

#include <Arduino.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>

ESP8266WiFiMulti WiFiMulti;
String value = "4";
String phonum = "0542235971";
String phone = "";
String phone1 = "";

String phone_z = "";
String phone_x = "";
String phone_y = "";
String phone_w = "";
String phone_v = "";
String phone_u = "";

void dayforme();

void setup()
{

  Serial.begin(115200);
  // Serial.setDebugOutput(true);

  Serial.println();
  Serial.println();
  Serial.println();

  for (uint8_t t = 4; t > 0; t--)
  {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("BRICH COMPANY LTD", "brichonline000");
  dayforme();
}

void loop()
{
  // wait for WiFi connection

  dayforme();
  delay(2000);
  phone1 = "";
}

void dayforme()
{
  if ((WiFiMulti.run() == WL_CONNECTED))
  {

    WiFiClient client;

    Serial.println("a");
    delay(1000);
    if (Serial.available())
    {
      phone1 = Serial.readString();
      phone_z = phone1.substring(1, 4);
      phone_x = phone1.substring(5, 9);
      phone_y = phone1.substring(10, 14);
      phone_w = phone1.substring(15, 19);
      phone_v = phone1.substring(20, 25);
      phone_u = phone1.substring(26, 30);
      phone.trim();
      Serial.println(phone);
      if (Serial.available())
      {
        phone1 = Serial.readString();
        phone1.trim();
        phone_z.trim();
        phone_x.trim();
        phone_y.trim();
        phone_w.trim();
        phone_u.trim();
        phone_v.trim();
        Serial.println(phone1);
      }

      // Serial.println(phone);   http://brichghana.com/app.bvs.airtimebot/airtimeBot/db.php?phonum="+phonum+"&value="+value+"&phone="+phone+"
      HTTPClient http;
      String url = "http://brichghana.com/app.bvs.airtimebot/airtimeBot/db.php?phonum=" + phonum + "     &value=10    &phone=" + phone_z + "      &phone_x=" + phone_x + "      &phone_y=" + phone_y + "&phone_u=" + phone_u + "&phone_v=" + phone_v + " &phone_w=" + phone_w+ "";
      if (http.begin(client, url))
      { // HTTP

        //Serial.print("[HTTP] GET...\n");
        // start connection and send HTTP header
        int httpCode = http.GET();

        // httpCode will be negative on error
        if (httpCode > 0)
        {
          // HTTP header has been send and Server response header has been handled
          Serial.printf("[HTTP] GET... code: %d\n", httpCode);

          // file found at server
          if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY)
          {
            String payload = http.getString();
            Serial.print("url ->");
          
            Serial.println(url);
            if (Serial.available())
            {
              phone1 = Serial.readString();
              phone1.trim();
              Serial.println(phone1);
              phone1 = "";
            }
            Serial.println(payload);
            if (Serial.available())
            {
              phone1 = Serial.readString();
              phone1.trim();
              Serial.println(phone1);
              phone1 = "";
            }
            // value = payload;
          }
        }
        else
        {
          //Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
        }

        http.end();
      }
      else
      {
        //Serial.printf("[HTTP} Unable to connect\n");
      }
    }
  }
}
