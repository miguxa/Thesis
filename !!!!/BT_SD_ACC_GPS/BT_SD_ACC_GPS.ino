#include <SparkFun_ADXL345.h>
#include <Lib.h>
#include <SD.h>
#include <SoftwareSerial.h>

#define FILE_WRITE (O_READ | O_APPEND |O_WRITE | O_CREAT)
SoftwareSerial ss (9, 8);
const int sentenceSize = 80;
char sentence[sentenceSize];
int ctrl = 0;

ADXL345 adxl = ADXL345();
int TAPS[6] = {0};
int ligado = 79;
int aberto = 0;
String aux = "";

void setup()
{
  Serial.begin(9600);
  ss.begin(9600);
  pinMode(2, INPUT);
  pinMode(3, OUTPUT);
  pinMode(4, OUTPUT);
  digitalWrite(3, LOW);
  digitalWrite(4, LOW);
  randomSeed(analogRead(A0));
  SD_init();
  AccelInit();
}

void loop()
{
  int ret = 0;

  while (Serial.available() > 0) {
    ligado = Serial.read();

    if (ligado == 73) {
      digitalWrite(3, HIGH);
      if (aberto == 0) {
        //ReadSD();
        aberto = 1;
      }
    }
    if (ligado == 79) {
      digitalWrite(3, LOW);
      aberto = 0;
    }
  }

  adxl.readAccel(&TAPS[3], &TAPS[4], &TAPS[5]);
  ret = Accel(TAPS[0], TAPS[1], TAPS[2], TAPS[3], TAPS[4], TAPS[5]);

  if (ret && (ctrl == 0)) {
    digitalWrite(4, HIGH);
    delay(300);
    digitalWrite(4, LOW);
    delay(300);

    String S;
    S = S + ret;
    S = S + " ";
    
    while (ctrl == 0)
      displayGPS(S);
    ctrl = 0;

    if (ligado == 79)
      WriteSD(S);
    if (ligado == 73)
      Serial.print(S);

    TAPS[3] = 0;
    TAPS[4] = 0;
    TAPS[5] = 0;
    delay(1000);

  }

  TAPS[0] = TAPS[3];
  TAPS[1] = TAPS[4];
  TAPS[2] = TAPS[5];
}

void AccelInit() {
  adxl.powerOn();
  adxl.setRangeSetting(4);
  adxl.setSpiBit(0);
  adxl.setTapDetectionOnXYZ(0, 0, 1);
  adxl.setTapThreshold(250);
  adxl.setTapDuration(40);
  adxl.setFreeFallThreshold(7);
  adxl.setFreeFallDuration(30);
  adxl.FreeFallINT(1);
  adxl.singleTapINT(1);
  digitalWrite(3, HIGH);
  delay(500);
  digitalWrite(3, LOW);
  delay(500);
}

void SD_init() {
  if (!SD.begin(10)) {
    Serial.println("Falha na leitura do cartao");
  }
  else {
    digitalWrite(3, HIGH);
    delay(500);
    digitalWrite(3, LOW);
    delay(500);
    if (SD.exists("datalog.txt"))
      SD.remove("datalog.txt");
  }
}

void WriteSD (String aux) {
  File fich = SD.open("datalog.txt", FILE_WRITE);
  if (fich) {
    digitalWrite(3, HIGH);
    delay(500);
    digitalWrite(3, LOW);
    delay(500);
    fich.print(aux);
    fich.close();
  }
  else {
    digitalWrite(3, HIGH);
    delay(100);
    digitalWrite(3, LOW);
    delay(100);
    digitalWrite(3, HIGH);
    delay(100);
    digitalWrite(3, LOW);
    delay(100);
  }
}

void ReadSD () {
  File myFile = SD.open("datalog.txt");
  if (myFile) {
    char readChar;
    while (myFile.available()) {
      readChar = myFile.read();
      Serial.print(readChar);
    }
    myFile.close();
    SD.remove("datalog.txt");
  }
}

int Accel(int &oldX, int &oldY, int &oldZ, int &newX, int &newY, int &newZ) {
  if ( abs(oldX - newX) > 500 && abs(oldY - newY) > 500 && abs(oldZ - newZ) > 500 )
    return 5;

  else if ( abs(oldX - newX) > 400 && abs(oldY - newY) > 400 && abs(oldZ - newZ) > 400 )
    return 4;

  else if ( abs(oldX - newX) > 300 && abs(oldY - newY) > 300 && abs(oldZ - newZ) > 300 )
    return 3;

  else if ( abs(oldX - newX) > 200 && abs(oldY - newY) > 200 && abs(oldZ - newZ) > 200 )
    return 2;

  else if ( abs(oldX - newX) > 100 && abs(oldY - newY) > 100 && abs(oldZ - newZ) > 100 )
    return 1;

  else
    return 0;
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
    if (ch != '\n' && i < sentenceSize)
    {
      sentence[i] = ch;
      i++;
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
        else
          S = S + '+';

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
        else
          S = S + '+';          
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
        S = S + "=\n";
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
