
const int ACC_X=A0; 
const int ACC_Y=A1;
const int ACC_Z=A2;

int acc_x_raw=0;
double center_x=0;
double acc_x=0.0;
  
int acc_y_raw=0;
double center_y=0;
double acc_y=0.0;
  
int acc_z_raw=0;
double center_z=0;
double acc_z=0.0;

void setup()
{
  Serial.begin(9600);
  analogReference(EXTERNAL);
  
  pinMode(A0,INPUT);
  pinMode(ACC_Y,INPUT);
  pinMode(ACC_Z,INPUT);
  
  center_x = (double)analogRead(ACC_X) * 5.0 / 1024.0;
  center_y = (double)analogRead(ACC_Y) * 5.0 / 1024.0;
  center_z = (double)analogRead(ACC_Z) * 5.0 / 1024.0;
}

void loop()
{
    acc_x_raw = analogRead(A0);
    acc_y_raw = analogRead(ACC_Y);
    acc_z_raw = analogRead(ACC_Z);
    
    Serial.print("X: "); 
    //acc_x = ((double)acc_x_raw * 5.0 / 1024.0 - center_x ) / 0.6;
    Serial.print(acc_x_raw);
    
    Serial.print(" Y: "); 
    acc_y = ((double)acc_y_raw * 5.0 / 1024.0 - center_y ) / 0.6;
    Serial.print(acc_y);
    
    Serial.print(" Z: "); 
    acc_z = ((double)acc_z_raw * 5.0 / 1024.0 - center_z ) / 0.6;
    Serial.println(acc_z);

    delay(200);
}
