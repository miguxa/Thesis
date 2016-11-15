package com.example.miguel.othertest;

import android.app.Activity;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothSocket;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ArrayAdapter;
import android.widget.AdapterView;
import android.view.View.OnClickListener;
import android.bluetooth.BluetoothDevice;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Set;

public class MainActivity extends Activity {
    int aux = 0;
    private BluetoothAdapter BA;
    private Set<BluetoothDevice> emparelhados;
    ListView lv;
    BluetoothSocket btSocket = null;
    public static String EXTRA_ADDRESS = "device_address";

    @Override
    protected void onCreate(Bundle icicle) {
        super.onCreate(icicle);
        setContentView(R.layout.activity_main);

        final Button button1 =(Button) findViewById(R.id.button1);
        final Button button2 =(Button) findViewById(R.id.button2);
        final Button button3 =(Button) findViewById(R.id.button3);
        final Button button4 =(Button) findViewById(R.id.button4);
        BA = BluetoothAdapter.getDefaultAdapter();
        lv = (ListView)findViewById(R.id.list1);
        ArrayList listaAux = new ArrayList();
        emparelhados = BA.getBondedDevices();


        if (BA == null) {
            Toast.makeText(getApplicationContext(), "Bluetooth não disponivel", Toast.LENGTH_LONG);
            finish();
        }
        else
            if (!BA.isEnabled()) {
                Intent turnOn = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
                startActivityForResult(turnOn, 0);
            }

        button3.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                TextView view = (TextView) findViewById(R.id.textView1);
                if (aux%2 == 0)
                    view.setText("Alpha");
                else
                    view.setText("Beta");
                aux ++;
            }
        });

        for (BluetoothDevice bt : emparelhados)
            listaAux.add(bt.getName());
        final ArrayAdapter adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, listaAux);
        lv.setAdapter(adapter);

        button4.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                pairedDevicesList();
            }
        });



    }

    private void pairedDevicesList()
    {
        emparelhados = BA.getBondedDevices();
        ArrayList list = new ArrayList();

        if (emparelhados.size()>0)
        {
            for(BluetoothDevice bt : emparelhados)
            {
                list.add(bt.getName() + "\n" + bt.getAddress()); //Get the device's name and the address
            }
        }
        else
        {
            Toast.makeText(getApplicationContext(), "No Paired Bluetooth Devices Found.", Toast.LENGTH_LONG).show();
        }

        final ArrayAdapter adapter = new ArrayAdapter(this,android.R.layout.simple_list_item_1, list);
        lv.setAdapter(adapter);
    }

    public void on (View v) {
        if (!BA.isEnabled()) {
            Intent turnOn = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
            startActivityForResult(turnOn, 0);
            Toast.makeText(getApplicationContext(), "Ligado", Toast.LENGTH_LONG).show();
        }
        else {
            Toast.makeText(getApplicationContext(), "Já estava ligado", Toast.LENGTH_LONG).show();
        }
    }

    public void off (View v) {
        BA.disable();
        Toast.makeText(getApplicationContext(), "Desligado", Toast.LENGTH_LONG).show();
    }

    private void msg(String s) {
        Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
    }

    private void turnOffLed()
    {
        if (btSocket!=null)
        {
            try
            {
                btSocket.getOutputStream().write("TF".toString().getBytes());
            }
            catch (IOException e)
            {
                msg("Error");
            }
        }
    }

    private void turnOnLed()
    {
        if (btSocket!=null)
        {
            try
            {
                btSocket.getOutputStream().write("TO".toString().getBytes());
            }
            catch (IOException e)
            {
                msg("Error");
            }
        }
    }
}
