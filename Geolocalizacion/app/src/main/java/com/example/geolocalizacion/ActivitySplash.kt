package com.example.geolocalizacion

import android.content.Intent
import android.os.Bundle
import android.os.Handler
import androidx.appcompat.app.AppCompatActivity

//IMPORTANTE, En la vistadel ACTIVITY_MAIN los colores y los efectos de los botones los hice de este video
//https://www.youtube.com/watch?v=kjqr4qfREw0 y en drawable estan los efectos, para poder cambiarlos a futuro

class ActivitySplash : AppCompatActivity() {

    //PARA LA BARRA DE CARGA https://www.develou.com/progressbar-en-android/

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_splash)

        //val intent = Intent(this, MainActivity::class.java)
        //startActivity(intent);

        //Para pasar de una actividad a otra
        //https://es.stackoverflow.com/questions/275478/como-pasar-de-una-activity-a-otra-pero-con-tiempo-sin-ning%C3%BAn-bot%C3%B3n
        val tiempoTranscurrir = 1500 //1 segundo, 1000 millisegundos.

        val handler = Handler()
        handler.postDelayed(Runnable { //***Aquí agregamos el proceso a ejecutar.
            val intent = Intent(applicationContext, MainActivity::class.java)
            startActivity(intent)
            //esto es para finalisar esta vista, cosa que si aprietan para atras no puedan volver
            finish()

        }, tiempoTranscurrir.toLong()) //define el tiempo.


    }
}