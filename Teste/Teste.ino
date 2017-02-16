#include <SparkFun_ADXL345.h>
#include <Lib.h>
//#include <SD.h>
#include <SoftwareSerial.h>

#define FILE_WRITE (O_READ | O_APPEND |O_WRITE | O_CREAT)
SoftwareSerial gpsSerial (9, 8);
const int sentenceSize = 80;
char sentence[sentenceSize];

ADXL345 adxl = ADXL345();
int TAPS[6] = {0};
int ligado = 79;
int aberto = 0;
String aux="";

void setup()
{
  Serial.begin(9600);
  gpsSerial.begin(9600);
  pinMode(2, INPUT);
  pinMode(3, OUTPUT);
  pinMode(4, OUTPUT);
  digitalWrite(3, LOW);
  digitalWrite(4, LOW);
  randomSeed(analogRead(A0)); 
  //SD_init();
  AccelInit();
}

void loop()
{
  static int ret = 1;
  /*
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
  */
  //adxl.readAccel(&TAPS[3], &TAPS[4], &TAPS[5]);
  //ret = Accel(TAPS[0], TAPS[1], TAPS[2], TAPS[3], TAPS[4], TAPS[5]);
  
  if (ret) {
    //digitalWrite(4, HIGH);
    //delay(300);
    //digitalWrite(4, LOW);
    //delay(300);
    
    String S;
    
    /*
    S = S + ret + " +" + Lat1 + ".";

    if (Lat2 < 10)
      S = S + "0";
    if (Lat2 < 100)
      S = S + "0";
    if (Lat2 < 1000)
      S = S + "0";

    S = S + Lat2 + " -0" + Lon1 + ".";
    
    if (Lon2 < 10)
      S = S + "0";
    if (Lon2 < 100)
      S = S + "0";
    if (Lon2 < 1000)
      S = S + "0";
    
    S = S + Lon2 + " " + "2017" + "-";
    
    if (mes < 10)
      S = S + "0";
      
    S = S + mes + "-";
    
    if (dia < 10)
      S = S + "0";
      
    S = S + dia + " ";
    
    if (hora < 10)
      S = S + "0";
      
    S = S+ hora + ":";
    
    if (minutos < 10)
      S = S + "0";
      
    S = S + minutos + "=\n";
    */
    //if (ligado == 79)
      //WriteSD(S);
    if (ligado == 73)
      Serial.print(S);
    
    TAPS[3] = 0;
    TAPS[4] = 0;
    TAPS[5] = 0;
    displayGPS();
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
/*
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
*/
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
