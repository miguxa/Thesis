#include <SD.h>
void setup()
{
  Serial.begin(9600);
  Serial.print("Initializing SD card...");
  // see if the card is present and can be initialized:
  if (!SD.begin(10))
    Serial.println("Card failed, or not present");
  else {
    Serial.println("card initialized.");
    if (SD.exists("datalog.txt"))
      SD.remove("datalog.txt");
  }
}

void loop()
{
  String frase = ("HELLO");  
  File fich = SD.open("datalog.txt", FILE_WRITE);
  if (fich) {
    fich.println(frase);
    fich.close();
    Serial.println(frase);
  }
  else 
    Serial.println("error opening datalog.txt");
  delay(2000);
}
