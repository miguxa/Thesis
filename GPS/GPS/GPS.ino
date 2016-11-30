#include <SoftwareSerial.h>
SoftwareSerial ss(3,4);
char c;
void setup() {
  Serial.begin(115200);
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
