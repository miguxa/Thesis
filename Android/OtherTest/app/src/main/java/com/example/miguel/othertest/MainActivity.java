package com.example.miguel.othertest;

import android.app.Activity;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Set;

public class MainActivity extends Activity {
    int aux = 0;
    private BluetoothAdapter BA;
    private Set<BluetoothDevice> emparelhados;
    ListView lv;

    @Override
    protected void onCreate(Bundle icicle) {
        super.onCreate(icicle);
        setContentView(R.layout.activity_main);

        final Button button =(Button) findViewById(R.id.button3);
        BA = BluetoothAdapter.getDefaultAdapter();
        lv = (ListView)findViewById(R.id.list1);
        ArrayList listaAux = new ArrayList();
        emparelhados = BA.getBondedDevices();

        button.setOnClickListener(new View.OnClickListener() {
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
}
