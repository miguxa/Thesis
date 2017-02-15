#include <SoftwareSerial.h>

SoftwareSerial gpsSerial(9, 8); // RX, TX (TX not used)
const int sentenceSize = 80;
char sentence[sentenceSize];

void setup()
{
  Serial.begin(9600);
  gpsSerial.begin(9600);
}

void loop()
{
  displayGPS();
}

void displayGPS()
{
  static int i = 0;
  if (gpsSerial.available())
  {
    char ch = gpsSerial.read();
    if (ch != '\n' && i < sentenceSize)
    {
      sentence[i] = ch;
      i++;
    }
    else
    {
      sentence[i] = '\0';
      i = 0;
      char field[20];
      getField(field, 0);
      if (strcmp(field, "$GPRMC") == 0)
      {
        Serial.print("Lat: ");
        getField(field, 3);  // number
        Serial.print(field);
        getField(field, 4); // N/S
        Serial.print(field);

        Serial.print(" Long: ");
        getField(field, 5);  // number
        Serial.print(field);
        getField(field, 6);  // E/W
        Serial.print(field);

        Serial.print(" Data: ");
        getField(field, 9);
        Serial.print(field);

        Serial.print(" Hora: ");
        getField(field, 1);
        Serial.print(field);
        
        Serial.println("");
      }
    }
  }
}

void getField(char* buffer, int index)
{
  int sentencePos = 0;
  int fieldPos = 0;
  int commaCount = 0;
  while (sentencePos < sentenceSize)
  {
    if (sentence[sentencePos] == ',')
    {
      commaCount ++;
      sentencePos ++;
    }
    if (commaCount == index)
    {
      buffer[fieldPos] = sentence[sentencePos];
      fieldPos ++;
    }
    sentencePos ++;
  }
  buffer[fieldPos] = '\0';
}
