/*

  mutiple if statements to handle serial buffer

*/

void setup()
{
  // initialize serial communication:
  Serial.begin(115200);
  // initialize the LED pins:
  for (int thisPin = 2; thisPin < 7; thisPin++)
  {
    pinMode(thisPin, OUTPUT);
    Serial.println();
  }

  Serial.println("readyfor message");
}

void loop()
{
  // read the sensor:
  if (Serial.available() > 0)

  {
    String data = Serial.readString();

    int inByte = data.charAt(0);

    Serial.print("this ->");
    Serial.println(inByte);
    switch (inByte)
    {
    case 'a':
      Serial.println("hellow the first is called");
      break;
    case 'b':
      digitalWrite(3, HIGH);
      break;
    case 'c':
      digitalWrite(4, HIGH);
      break;
    case 'd':
      digitalWrite(5, HIGH);
      break;
    case 'e':
      digitalWrite(6, HIGH);
      break;
    default:
      // just keep listening to port:
      Serial.println("defualt value here");
    }

    delay(3000);

    Serial.println("Please enter serial buffer");
  }
}