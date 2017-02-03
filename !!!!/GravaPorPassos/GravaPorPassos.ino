#include <SparkFun_ADXL345.h>
#include <Lib.h>
#include <SD.h>
#define FILE_WRITE (O_READ | O_APPEND |O_WRITE | O_CREAT)

ADXL345 adxl = ADXL345();
Prints P;
int TAPS[6] = {0};
int ligado = 79;
int aberto = 0;
String aux="";

void setup()
{
  Serial.begin(9600);
  pinMode(2, INPUT);
  pinMode(3, OUTPUT);
  pinMode(4, OUTPUT);
  digitalWrite(3, LOW);
  digitalWrite(4, LOW);
  SD_init();
  AccelInit();
}

void loop()
{
  int ret = 0;

  while (Serial.available() > 0) {
    ligado = Serial.read();

    if (ligado == 73){
      digitalWrite(3, HIGH);
      if (aberto == 0) {
        ReadSD();
        aberto=1;
      }
    }
    if (ligado == 79) {
      digitalWrite(3, LOW);
      aberto=0;
    }
  }

  adxl.readAccel(&TAPS[3], &TAPS[4], &TAPS[5]);
  ret = Accel(TAPS[0], TAPS[1], TAPS[2], TAPS[3], TAPS[4], TAPS[5]);

  if (ret) {
    digitalWrite(4, HIGH);
    delay(300);
    digitalWrite(4, LOW);
    String S;
    S = S + P.Sinal(TAPS[0]);
    S = S + P.Sinal(TAPS[1]);
    S = S + P.Sinal(TAPS[2]);
    S = S + P.Sinal(TAPS[3]);
    S = S + P.Sinal(TAPS[4]);
    S = S + P.Sinal(TAPS[5]);
    S = S + ret;
    S = S + "=\n";

    if (ligado == 79)
      WriteSD(S);
    if (ligado == 73)
      Serial.print(S);

    TAPS[3] = 0;
    TAPS[4] = 0;
    TAPS[5] = 0;
    delay(300);
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
  if (fich){
    digitalWrite(3, HIGH);
    delay(500);
    digitalWrite(3, LOW);
    delay(500);
    fich.println(aux);
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
