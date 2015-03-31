package com.gooftroop.tourbuddy;

import android.util.Log;

import org.apache.http.HttpResponse;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Created by Austin on 2/25/2015.
 */
public class HttpClientHelper {

    public static HttpResponse visitLocation(CampusLocation location)
    {
        try
        {
//            List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(2);
//
//            nameValuePairs.add(new BasicNameValuePair("building_id", "1"));
//            nameValuePairs.add(new BasicNameValuePair("type", "visit"));
            JSONObject req = new JSONObject();
            req.put("building_id", 1);
            req.put("type", "visit");
            return httpPostJSON(req, "http://gala.cs.iastate.edu/~erichk/index.php");
            //httpPostJSON();
            //httpPost(nameValuePairs, "http://gala.cs.iastate.edu/~erichk/index.php", curContext);
        }
        catch (Exception e)
        {
            System.out.println(e.getMessage());
            return null;
        }
    }

    public static HttpResponse httpPostJSON(JSONObject req, String url) throws Exception
    {
        DefaultHttpClient httpclient = new DefaultHttpClient();

        HttpPost httpPost = new HttpPost(url);

        if (req != null)
        {
            StringEntity se = new StringEntity(req.toString());

            //sets the post request as the resulting string
            httpPost.setEntity(se);
        }

        //Set the http post headers
        httpPost.setHeader("Accept", "application/json");
        httpPost.setHeader("Content-type", "application/json; charset=utf-8");

        //Handles what is returned from the page
        HttpResponse response = httpclient.execute(httpPost);
        return response;
    }

//    public static void httpPost(List<NameValuePair> nameValuePairs, String url, Context curContext) throws Exception {
//        DefaultHttpClient httpclient = new DefaultHttpClient();
//
//        HttpPost httpost = new HttpPost(url);
//
//        httpost.setEntity(new UrlEncodedFormEntity(nameValuePairs));
//
//        //Handles what is returned from the page
//        HttpResponse response = httpclient.execute(httpost);
//
//        Toast.makeText(curContext, "Response code:" + response.getStatusLine().getStatusCode(), Toast.LENGTH_LONG).show();
//    }

    public String readUrl(String mapsApiDirectionsUrl) throws IOException {
        String data = "";
        InputStream iStream = null;
        HttpURLConnection urlConnection = null;
        try {
            URL url = new URL(mapsApiDirectionsUrl);
            urlConnection = (HttpURLConnection) url.openConnection();
            urlConnection.connect();
            iStream = urlConnection.getInputStream();
            BufferedReader br = new BufferedReader(new InputStreamReader(
                    iStream));
            StringBuffer sb = new StringBuffer();
            String line = "";
            while ((line = br.readLine()) != null) {
                sb.append(line);
            }
            data = sb.toString();
            br.close();
        } catch (Exception e) {
            Log.d("Exception while reading url", e.toString());
        } finally {
            iStream.close();
            urlConnection.disconnect();
        }
        return data;
    }
}
