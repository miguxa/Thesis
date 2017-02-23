#include <SoftwareSerial.h>
SoftwareSerial ss(9,8);
char c;
void setup() {
  Serial.begin(9600);
  ss.begin(9600);
  Serial.println("Begin...");
  delay(1000);
}

void loop() {
  while (ss.available()) {
    c = ss.read();
    Serial.print(c);
  }
}
