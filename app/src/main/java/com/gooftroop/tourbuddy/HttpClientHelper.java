package com.gooftroop.tourbuddy;

import android.content.Context;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Austin on 2/25/2015.
 */
public class HttpClientHelper {

    public static void visitLocation(CampusLocation location, Context curContext)
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
            httpPostJSON(req, "http://gala.cs.iastate.edu/~erichk/index.php", curContext);
            //httpPostJSON();
            //httpPost(nameValuePairs, "http://gala.cs.iastate.edu/~erichk/index.php", curContext);
        }
        catch (Exception e)
        {
            System.out.println(e.getMessage());
        }
    }

    public static void httpPost(List<NameValuePair> nameValuePairs, String url, Context curContext) throws Exception {
        DefaultHttpClient httpclient = new DefaultHttpClient();

        HttpPost httpost = new HttpPost(url);

        httpost.setEntity(new UrlEncodedFormEntity(nameValuePairs));

        //Set the http post headers
        //httpost.setHeader("Accept", "application/json");
        //httpost.setHeader("Content-type", "application/json");

        //Handles what is returned from the page
        HttpResponse response = httpclient.execute(httpost);

        Toast.makeText(curContext, "Response code:" + response.getStatusLine().getStatusCode(), Toast.LENGTH_LONG).show();
    }

    public static void httpPostJSON(JSONObject req, String url, Context curContext) throws Exception
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
        ResponseHandler<String> responseHandler = new BasicResponseHandler();
        HttpResponse response = httpclient.execute(httpPost);

        Toast.makeText(curContext, "Response code:" + response.getStatusLine().getStatusCode(), Toast.LENGTH_LONG).show();
    }
}
