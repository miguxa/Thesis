#include <SoftwareSerial.h>

SoftwareSerial ss(9, 8); // RX, TX (TX not used)
const int sentenceSize = 80;
char sentence[sentenceSize];
int ctrl = 0;
String S;

void setup()
{
  Serial.begin(9600);
  ss.begin(9600);
  pinMode(2, INPUT);
  Serial.println("Hello World...");
}

void loop()
{
  int Read = digitalRead(2);
  if (ctrl == 0) {
    displayGPS(S);
    Serial.print(S);
  }
}

void displayGPS(String &S)
{
  static int i = 0;
  char ch;
  char field[10];
  char help[3];
  int num1;
  double num2;
  if (ss.available())
  {
    ch = ss.read();
    //Serial.print(ch);
    if (ch != '\n' && i < sentenceSize)
    {
      sentence[i] = ch;
      i++;
      //S = "ERRO\n";
    }
    else
    {

      sentence[i] = '\0';
      i = 0;
      getField(field, 0);
      if (strcmp(field, "$GPRMC") == 0)
      {
        getField(field, 4); // N/S
        if (field[0] == 'S')
          S = S + '-';

        getField(field, 3);  //Latitude
        help[0] = field[2];
        help[1] = field[3];
        help[2] = "\0";
        help[3] = "\0";
        num1 = atoi(help);
        help[0] = field[5];
        help[1] = field[6];
        help[2] = field[7];
        help[3] = field[8];
        num2 = atoi(help);
        num2 = num2 / 10000;
        num2 = num1 + num2;
        help[0] = field[0];
        help[1] = field[1];
        help[2] = "\0";
        help[3] = "\0";
        num1 = atoi(help);
        num2 = num1 + num2 / 60;

        S = S + FTOA(num2);
        S = S + " ";

        getField(field, 6); // E/W
        if (field[0] == 'W')
          S = S + '-';
        getField(field, 5);  //Longitude
        help[0] = field[3];
        help[1] = field[4];
        help[2] = "\0";
        help[3] = "\0";
        num1 = atoi(help);
        help[0] = field[6];
        help[1] = field[7];
        help[2] = field[8];
        help[3] = field[9];
        num2 = atoi(help);
        num2 = num2 / 10000;
        num2 = num1 + num2;
        help[0] = field[0];
        help[1] = field[1];
        help[2] = field[2];
        help[3] = "\0";
        num1 = atoi(help);
        num2 = num1 + num2 / 60;
        S = S + FTOA(num2);
        S = S + " ";

        getField(field, 9); //Data
        help[0] = '2';
        help[1] = '0';
        help[2] = field[4];
        help[3] = field[5];
        num1 = atoi(help);
        S = S + num1;
        S = S + "-";
        help[0] = field[2];
        help[1] = field[3];
        help[2] = "\0";
        help[3] = "\0";
        num1 = atoi(help);
        if (num1 < 10)
          S = S + "0";
        S = S + num1;
        S = S + "-";
        help[0] = field[0];
        help[1] = field[1];
        help[2] = "\0";
        help[3] = "\0";
        num1 = atoi(help);
        if (num1 < 10)
          S = S + "0";
        S = S + num1;
        S = S + " ";

        getField(field, 1); //Hora
        help[0] = field[0];
        help[1] = field[1];
        help[2] = "\0";
        help[3] = "\0";
        num1 = atoi(help);
        if (num1 < 10)
          S = S + "0";
        S = S + num1;
        S = S + ":";
        help[0] = field[2];
        help[1] = field[3];
        help[2] = "\0";
        help[3] = "\0";
        num1 = atoi(help);
        if (num1 < 10)
          S = S + "0";
        S = S + num1;
        S = S + "\n";
        ctrl = 1;
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

String FTOA(double &F) {
  int i, a;
  String S;
  F = F / 10;
  for (a = 0; a < 7; a++) {
    if (a == 2)
      S = S + ".";
    else if (F > 0) {
      i = F;
      F = (F - i) * 10;
      S = S + i;
    }
  }
  return S;
}
