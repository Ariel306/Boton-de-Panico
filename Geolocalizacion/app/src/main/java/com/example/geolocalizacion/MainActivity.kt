package com.example.geolocalizacion

import android.content.Context
import android.os.Build
import android.os.Bundle
import android.os.Handler
import android.os.Looper
import android.provider.Settings.Secure
import android.telephony.TelephonyManager
import android.view.View
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.annotation.RequiresApi
import androidx.appcompat.app.AppCompatActivity
import com.android.volley.AuthFailureError
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException
import java.net.Inet4Address
import java.net.NetworkInterface
import java.net.UnknownHostException


//EL TAMAÑO DE LAS LETRAS DE BOTONES ESTA EN ESE LINK https://developer.android.com/guide/topics/ui/look-and-feel/autosizing-textview
// ES PARA HACER LAS LETRAS DE LOS BOTONES RESPONSIVE

class MainActivity : AppCompatActivity() {

    //Creo las variables para los Txt del .xml
    var LaIp: TextView? = null
    var LaMac: TextView? = null
    var Mensaje: TextView? = null

    @RequiresApi(Build.VERSION_CODES.M)
    override fun onCreate(savedInstanceState: Bundle?) {
        //ESTE CODIGO setTheme(R.style.Theme_Geolocalizacion) ES PARA EL SPLASH SCREEN
        //https://www.youtube.com/watch?v=ksaaMt8Lo6U
        //setTheme(R.style.Theme_Geolocalizacion)
        //VOY A PROBAR OTRA FORMA

        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        //esto es la libreira volley que me permite conectarme a la base de datos
        val queue = Volley.newRequestQueue(this)
        //aca pongo la url de mi servidor y donde esta almacenado el archivo que me permite conectarme a la base de datos
        //val url = "http://192.168.1.113/ConecBase/index.php"
        val url = "http://10.0.0.14/ConecBase/index.php"


        //ahora asociamos las variables creadas con los compenentes graficos
        //LaIp = findViewById(R.id.textView3)
        //LaMac = findViewById(R.id.textView2)
        Mensaje = findViewById(R.id.textView2)

        //creo una variable donde le asigno el button
        val ObtenerInfo = findViewById<Button>(R.id.button)
        val Borrar = findViewById<Button>(R.id.button2)
        val Ubicacion = findViewById<Button>(R.id.button3)


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
        val host: String = "10.0.0.14"

        //REPETIR CADA CIERTO TIEMPO
        //https://es.stackoverflow.com/questions/429816/ejecutar-c%C3%B3digo-cada-n-segundos-con-kotlin
        val myHandler = Handler(Looper.getMainLooper())
        //ACA ADENTRO ESTAN LOS BOTONES, PERO HAGO QUE SE RESETEE EL CODIGO CADA 3 SEGUNDOS,
        //PARA VALIDAR QUE ESTE CONECTADO A LA RED
        myHandler.post(object : Runnable {
            @RequiresApi(Build.VERSION_CODES.O)
            override fun run() {
                //CODIGO QUE SE VA A REPETIR

                //BOTONES
                if (isConnectedToThisServer(host)) {

                    //LOS BOTONES PARA AVILITARLOS Y DESABILITARLOS
                    //https://es.stackoverflow.com/questions/23263/inhabilitar-un-boton
                    Borrar.setEnabled(true);
                    ObtenerInfo.setEnabled(true);
                    Ubicacion.setEnabled(true);

                    //val tel = getSystemService(Context.TELEPHONY_SERVICE) as TelephonyManager
                    //val IMEIr = tel.imei

                    //ESTO ES PARA OBTENER EL ID DEL TELEFONO, el cual nos va a servir para crearles un
                    //registro a cada usuario si se llega a querer
                    val myIMEI = Secure.getString(applicationContext.contentResolver, Secure.ANDROID_ID)

                    //METODO 2 PARA OBTENER IP DE TELEFONO
                    //https://es.stackoverflow.com/questions/356104/obtener-ip-hostname-kotlin
                    fun getIPHostAddress(): String {
                        NetworkInterface.getNetworkInterfaces()?.toList()?.map { networkInterface ->
                            networkInterface.inetAddresses?.toList()?.find {
                                !it.isLoopbackAddress && it is Inet4Address
                            }?.let { return it.hostAddress }
                        }
                        return "No se pudo mandar la Ubicacion"
                    }


                    //prueba para ver que ip tomaba del codigo de arriba
                    //Mensaje?.text = getIPHostAddress()

                    //Este contenido se va a mostrar en el TextView
                    Mensaje?.text = "TE ACOMPAÑAMOS"


                    //CUANDO SE MANDE LA EMERGENCIA, QUE SALGA POR EL TEXT QUE YA SE MANDO
                    /*
                    Ya esta resulto esto, al poner la IP como primary en la base de datos
                    se va a mandar el mensaje que se encuentra en index.php de la carpeta
                    ConecBase.
                    */


                    //button  = Necesito Ayuda = Tipo1
                    ObtenerInfo.setOnClickListener(View.OnClickListener {
                        /*
                        /*var bufferedReaderr: BufferedReader? = null
                        bufferedReaderr = BufferedReader(FileReader("/proc/net/arp"))
                        bufferedReaderr.forEachLine {
                            val splitted = it.split(" +".toRegex()).dropLastWhile { it.isEmpty() }.toTypedArray()
                            val ip = splitted[0]
                            var mac = ""
                            if (ip > "192.168.1.1"){
                                mac == "90:67:1c:8d:9b:31"
                            }else{
                                mac = splitted[3]
                            }
                            //val mac = splitted[3]
                            //Mac?.text = mac
                            //Ip?.text = splitted.contentToString()
                            if (mac.matches("..:..:..:..:..:..".toRegex())) {
                                //Toast.makeText(this, "La mac es , $mac",Toast.LENGTH_LONG).show()
                                //Toast.makeText(this, "La mac es , $mac",Toast.LENGTH_LONG).show()
                                //Toast.makeText(this, "La mac es , $ip",Toast.LENGTH_LONG).show()
                                /*if (ip == "192.168.1.41"){
                                    mac == "90:67:1c:8d:9b:31"
                                }*/
                                LaIp?.text = ip
                                LaMac?.text = mac
                            }
                        }*/

                        //probando algo de la red
                        //https://developer.android.com/training/basics/network-ops/reading-network-state
                        //val connectivityManager = getSystemService(ConnectivityManager::class.java)
                        //val currentNetwork = connectivityManager.getActiveNetwork()
                        //val caps = connectivityManager.getNetworkCapabilities(currentNetwork)
                        //val linkProperties = connectivityManager.getLinkProperties(currentNetwork)

                        //probandooo
                        //var Ip:TextView? = null
                        //var Mac:TextView? = null
                        //Ip = findViewById(R.id.textView3)
                        //Mac = findViewById(R.id.textView2)

                        //Ip?.text = linkProperties.toString()

                        //Toast.makeText(this, "Red, $currentNetwork",Toast.LENGTH_LONG).show()
                        //Toast.makeText(this, "Red2, $caps",Toast.LENGTH_LONG).show()

                        //Esto me muestra todos los datos que trae
                        //Toast.makeText(this, "Red3, $linkProperties",Toast.LENGTH_LONG).show()

                              var variableArray = arrayOf(linkProperties)
                              val strs = "$linkProperties".split("," , "[" , "]" , "->" , "{" , "}" , "/" )
                              var arr = strs.toTypedArray()
                              arr.forEach { Log.i("ArrayItem", " Array item=" + it) }

                              var miip = "pepe"
                              var tipo = 2

                              //Aca lo que hace es guardar en un text los datos que traemos de la red, en este caso el 4 es la IP
                              for (item in arr){
                                  //LaMac?.text = arr[19]
                                  //LaIp?.text = arr[4]
                                  //println("LOS VALORES SON: " + item )

                                  //https://uniwebsidad.com/libros/javascript/capitulo-4/ambito-de-las-variables
                                  //Aca tenia un problema con las variables locales y gobales, en ese link esta la solucion
                                  miip = arr[4]
                                  tipo = 1



                              }

                              //SIIIIIIIIII funciono
                              */
                        //ENVIANDO LA IP A LA BASE DE DATOS

                        var miip = getIPHostAddress()
                        var tipo = 1
                        var iden = myIMEI


                        val stringRequest = object : StringRequest(
                            Method.POST, url,
                            Response.Listener<String> { response ->
                                try {
                                    val obj = JSONObject(response)
                                    Toast.makeText(applicationContext,obj.getString("message") , Toast.LENGTH_LONG).show()
                                }catch (e:JSONException){
                                    e.printStackTrace()
                                }

                            },
                            Response.ErrorListener { volleyError -> Toast.makeText(applicationContext, volleyError.message, Toast.LENGTH_LONG).show() }) {
                            @Throws(AuthFailureError::class)

                            override fun getParams(): Map<String, String>{

                                val params = HashMap<String, String>()
                                params.put("ip",miip)
                                params.put("tipo", tipo.toString())
                                params.put("iden", iden)
                                return params
                            }
                        }

                        Mensaje?.text = "Su Ubicación Ya Fue Enviada"

                        // Add the request to the RequestQueue.
                        queue.add(stringRequest)
                        //ESTO NO HACE FALTA, PORQUE EN EL INDEX.PHP DE BASE DE DATOS YA ESTA EL MENSAJE
                        //Toast.makeText(this,"Ubicacion Enviada, Necesito Ayuda",Toast.LENGTH_LONG).show()




                    })

                    //button 2 = Urgencia = Tipo2
                    //Aca borramos los datos por las dudas
                    Borrar.setOnClickListener(View.OnClickListener {

                        //ENVIANDO LA IP A LA BASE DE DATOS
                        var miip = getIPHostAddress()
                        var tipo = 2
                        var iden = myIMEI

                        val stringRequest = object : StringRequest(
                            Method.POST, url,
                            Response.Listener<String> { response ->
                                try {
                                    val obj = JSONObject(response)
                                    Toast.makeText(applicationContext,obj.getString("message") , Toast.LENGTH_LONG).show()
                                }catch (e:JSONException){
                                    e.printStackTrace()
                                }

                            },
                            Response.ErrorListener { volleyError -> Toast.makeText(applicationContext, volleyError.message, Toast.LENGTH_LONG).show() }) {
                            @Throws(AuthFailureError::class)

                            override fun getParams(): Map<String, String>{

                                val params = HashMap<String, String>()
                                params.put("ip",miip)
                                params.put("tipo", tipo.toString())
                                params.put("iden", iden)
                                return params
                            }
                        }

                        Mensaje?.text = "Su Ubicación Ya Fue Enviada"
                        // Add the request to the RequestQueue.
                        queue.add(stringRequest)
                        //Toast.makeText(this,"Ubicacion Enviada, Urgencia",Toast.LENGTH_LONG).show()



                    })

                    //button 3 = Violencia de Genero = Tipo3
                    Ubicacion.setOnClickListener(View.OnClickListener {
                        /*
                        //val connectivityManager = getSystemService(ConnectivityManager::class.java)
                        //val currentNetwork = connectivityManager.getActiveNetwork()
                        //val caps = connectivityManager.getNetworkCapabilities(currentNetwork)
                        //val linkProperties = connectivityManager.getLinkProperties(currentNetwork)

                        //DESPUES BORRAR
                        //Toast.makeText(this, "Red3, $linkProperties",Toast.LENGTH_LONG).show()

                        //probandooo
                        //var Ip:TextView? = null
                        //var Mac:TextView? = null
                        //Ip = findViewById(R.id.textView3)
                        //Mac = findViewById(R.id.textView2)

                        //Ip?.text = linkProperties.toString()



                        //Toast.makeText(this, "Red, $currentNetwork",Toast.LENGTH_LONG).show()
                        //Toast.makeText(this, "Red2, $caps",Toast.LENGTH_LONG).show()

                        //Esto me muestra todos los datos que trae
                        //Toast.makeText(this, "Red3, $linkProperties",Toast.LENGTH_LONG).show()

                        var variableArray = arrayOf(linkProperties)
                        val strs = "$linkProperties".split("," , "[" , "]" , "->" , "{" , "}" , "/" )
                        var arr = strs.toTypedArray()
                        arr.forEach { Log.i("ArrayItem", " Array item=" + it) }

                        var miip = "pepe"
                        var tipo = 2

                        //Aca lo que hace es guardar en un text los datos que traemos de la red, en este caso el 4 es la IP
                        for (item in arr){
                            //LaMac?.text = arr[19]
                            //LaIp?.text = arr[4]
                            //println("LOS VALORES SON: " + item )

                            //https://uniwebsidad.com/libros/javascript/capitulo-4/ambito-de-las-variables
                            //Aca tenia un problema con las variables locales y gobales, en ese link esta la solucion
                            miip = arr[4]
                            tipo = 3


                        }
        */
                        //SI funciono

                        //ENVIANDO LA IP A LA BASE DE DATOS
                        var miip = getIPHostAddress()
                        var tipo = 3
                        var iden = myIMEI

                        val stringRequest = object : StringRequest(
                            Method.POST, url,
                            Response.Listener<String> { response ->
                                try {
                                    val obj = JSONObject(response)
                                    Toast.makeText(applicationContext,obj.getString("message") , Toast.LENGTH_LONG).show()
                                }catch (e:JSONException){
                                    e.printStackTrace()
                                }

                            },
                            Response.ErrorListener { volleyError -> Toast.makeText(applicationContext, volleyError.message, Toast.LENGTH_LONG).show() }) {
                            @Throws(AuthFailureError::class)

                            override fun getParams(): Map<String, String>{

                                val params = HashMap<String, String>()
                                params.put("ip",miip)
                                params.put("tipo", tipo.toString())
                                params.put("iden", iden)
                                return params
                            }
                        }

                        Mensaje?.text = "Su Ubicación Ya Fue Enviada"
                        // Add the request to the RequestQueue.
                        queue.add(stringRequest)
                        //Toast.makeText(this,"Ubicacion Enviada, Violencia de Genero",Toast.LENGTH_LONG).show()
                    })
                } else {
                    Mensaje?.text = "Conectate a una red FCPyS"
                    //Toast.makeText(this, "Debes Conectarte a FCPyS",Toast.LENGTH_LONG).show()
                    Borrar.setEnabled(false);
                    ObtenerInfo.setEnabled(false);
                    Ubicacion.setEnabled(false);
                }
                //FIN BOTONES

                myHandler.postDelayed(this, 10000 /*10 segundos*/)
            }
        })








    }
}