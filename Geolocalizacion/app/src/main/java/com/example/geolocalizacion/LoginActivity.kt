package com.example.geolocalizacion

import android.content.Intent
import android.os.Bundle
import android.os.Handler
import android.os.Looper
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.android.volley.AuthFailureError
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import java.io.IOException
import java.net.UnknownHostException
import java.util.*


class LoginActivity : AppCompatActivity() {

    //Creo las variables para los Txt del .xml
    var Mensaje: TextView? = null

    var editTextHello: EditText? = null
    var editpassword: EditText? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        //esto es la libreira volley que me permite conectarme a la base de datos
        val queue = Volley.newRequestQueue(this)
        //aca pongo la url de mi servidor y donde esta almacenado el archivo que me permite conectarme a la base de datos
        //val url = "http://192.168.1.113/ConecBase/index.php"
        val url = "http://10.0.17.117/ConecBase/login.php"

        //ahora asociamos las variables creadas con los compenentes graficos
        Mensaje = findViewById(R.id.textView)

        //Validar login A LA BASE DE DATOS

        editTextHello = findViewById(R.id.txtDNI)
        editpassword = findViewById(R.id.txtLegajo)

        val dni = editTextHello
        val password =editpassword

        //creo una variable donde le asigno el button
        val EnviarLogin = findViewById<Button>(R.id.button4)

        //Probando algo https://dev4phones.wordpress.com/2019/07/25/hacer-ping-a-una-direccion-ip-en-kotlin/
        fun isConnectedToThisServer(host: String): Boolean {

            val runtime = Runtime.getRuntime()
            try {
                val ipProcess = runtime.exec("/system/bin/ping -c 1 $host")
                val exitValue = ipProcess.waitFor()
                ipProcess.destroy()
                return exitValue == 0
            } catch (e: UnknownHostException) {
                e.printStackTrace()
            } catch (e: IOException) {
                e.printStackTrace()
            } catch (e: InterruptedException) {
                e.printStackTrace()
            }

            return false
        }
        val host: String = "10.0.17.117"

        //REPETIR CADA CIERTO TIEMPO
        //https://es.stackoverflow.com/questions/429816/ejecutar-c%C3%B3digo-cada-n-segundos-con-kotlin
        val myHandler = Handler(Looper.getMainLooper())
        //ACA ADENTRO ESTAN LOS BOTONES, PERO HAGO QUE SE RESETEE EL CODIGO CADA 3 SEGUNDOS,
        //PARA VALIDAR QUE ESTE CONECTADO A LA RED
        myHandler.post(object : Runnable {
            override fun run() {
                //CODIGO QUE SE VA A REPETIR

                //BOTONES

        if (isConnectedToThisServer(host)) {
            //Mensaje?.text = "Conectado"
            EnviarLogin.setEnabled(true);
            /*
            EnviarLogin.setOnClickListener(View.OnClickListener {




                val stringRequest = object : StringRequest(
                    Method.POST, url,
                    Response.Listener<String> { response ->
                        try {
                            val obj = JSONObject(response)
                            Toast.makeText(applicationContext,obj.getString("message") , Toast.LENGTH_LONG).show()
                        }catch (e: JSONException){
                            e.printStackTrace()
                        }

                    },
                    Response.ErrorListener { volleyError -> Toast.makeText(applicationContext, volleyError.message, Toast.LENGTH_LONG).show() }) {
                    @Throws(AuthFailureError::class)

                    override fun getParams(): Map<String, String>{
                        Mensaje?.text = "Iniciando Sesion"
                        val params = HashMap<String, String>()
                        params.put("dni", dni.toString())
                        params.put("password", password.toString())
                        return params

                    }

                }



                // Agregue la solicitud a RequestQueue.
                queue.add(stringRequest)

                //Para pasar al MainActivity
                //val intent = Intent(this, MainActivity::class.java)
                //startActivity(intent)
                //esto es para finalisar esta vista, cosa que si aprietan para atras no puedan volver
                //finish()


            })

*/
            EnviarLogin.setOnClickListener(View.OnClickListener {

                val stringRequest = object : StringRequest(
                    Method.POST, url,
                    Response.Listener<String>{ response -> // En este apartado se programa lo que deseamos hacer en caso de no haber errores

                        if (response == "ERROR 1") {
                            //Toast.makeText(this, "Se deben de llenar todos los campos.", Toast.LENGTH_SHORT).show()
                            Mensaje?.text = "Se deben de llenar todos los campos."
                            myHandler.postDelayed(this, 1000 /*10 segundos*/)
                        }else if (response == "ERROR 3"){
                            //Toast.makeText(this, "Inicio de Sesion exitoso.", Toast.LENGTH_LONG).show()
                            Mensaje?.text = "Inicio de Sesion exitoso."
                            cambio()
                        }else{
                            //Toast.makeText(this, "No existe ese registro.", Toast.LENGTH_SHORT).show()
                            Mensaje?.text = "No existe ese registro."
                            myHandler.postDelayed(this, 1000 /*10 segundos*/)
                        }
                    }, Response.ErrorListener { // En caso de tener algun error en la obtencion de los datos
                            volleyError -> Toast.makeText(applicationContext, volleyError.message, Toast.LENGTH_LONG).show() }) {
                    @Throws(AuthFailureError::class)
                    override fun getParams(): Map<String, String> {

                        // En este metodo se hace el envio de valores de la aplicacion al servidor
                        //val parametros: MutableMap<String, String> = Hashtable<String, String>()
                        //parametros["dni"] = dni?.text.toString().trim()
                        //parametros["password"] = password?.text.toString().trim()
                        //return parametros

                        val params = HashMap<String, String>()
                        params.put("dni", dni?.text.toString())
                        params.put("password", password?.text.toString())
                        return params
                    }

                   /*
                    override fun getParams(): Map<String, String>? {

                        // En este metodo se hace el envio de valores de la aplicacion al servidor
                        val parametros: MutableMap<String, String> = Hashtable()
                        parametros["usuario"] = etUsuario.getText().toString().trim()
                        parametros["contrasena"] = etContrasena.getText().toString().trim()
                        return parametros
                    }*/

                }
                //val requestQueue = Volley.newRequestQueue(this)
                queue.add(stringRequest)

                //Esto era para ver si guardaba los datos
                //Mensaje?.text = dni?.text.toString()

            })


        } else {
            Mensaje?.text = "Conectate a una red FCPyS"
            EnviarLogin.setEnabled(false);
            //Toast.makeText(this, "Debes Conectarte a FCPyS",Toast.LENGTH_LONG).show()
            //myHandler.postDelayed(this, 5000 /*10 segundos*/)
            myHandler.postDelayed(this, 8000 /*8 segundos*/)
        }
                //FIN BOTONES

            }
        })



        //Para pasar de una actividad a otra
        //https://es.stackoverflow.com/questions/275478/como-pasar-de-una-activity-a-otra-pero-con-tiempo-sin-ning%C3%BAn-bot%C3%B3n
        //val tiempoTranscurrir = 9500 //1 segundo, 1000 millisegundos.

        //val handler = Handler()
        //handler.postDelayed(Runnable { //***Aquí agregamos el proceso a ejecutar.
        //    val intent = Intent(applicationContext, MainActivity::class.java)
        //    startActivity(intent)
            //esto es para finalisar esta vista, cosa que si aprietan para atras no puedan volver
        //    finish()

        //}, tiempoTranscurrir.toLong()) //define el tiempo.


    }


    private fun cambio(): Any {
    //Para pasar al MainActivity
        val intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
        //esto es para finalisar esta vista, cosa que si aprietan para atras no puedan volver
        return finish()
    }
/*
    fun login() {
        val url = "http://10.0.17.117/ConecBase/login1.php"
        val stringRequest: StringRequest
        stringRequest = object : StringRequest(
            Method.POST, url,
            Response.Listener { response -> // En este apartado se programa lo que deseamos hacer en caso de no haber errores
                if (response == "ERROR 1") {
                    Toast.makeText(
                        this,
                        "Se deben de llenar todos los campos.",
                        Toast.LENGTH_SHORT
                    ).show()
                } else if (response == "ERROR 2") {
                    Toast.makeText(this, "No existe ese registro.", Toast.LENGTH_SHORT).show()
                } else {
                    Toast.makeText(this, "Inicio de Sesion exitoso.", Toast.LENGTH_LONG)
                        .show()
                }
            }, Response.ErrorListener { // En caso de tener algun error en la obtencion de los datos
                Toast.makeText(this, "ERROR AL INICIAR SESION", Toast.LENGTH_LONG).show()
            }) {
            @Throws(AuthFailureError::class)
            override fun getParams(): Map<String, String>? {

                // En este metodo se hace el envio de valores de la aplicacion al servidor
                val parametros: MutableMap<String, String> = Hashtable<String, String>()
                parametros["dni"] = dni.getText().toString().trim()
                parametros["password"] = password.getText().toString().trim()
                return parametros


            }
        }
        val requestQueue = Volley.newRequestQueue(this)
        requestQueue.add(stringRequest)

        //Para pasar al MainActivity
        val intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
        //esto es para finalisar esta vista, cosa que si aprietan para atras no puedan volver
        finish()
    }*/
}