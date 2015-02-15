package com.gooftroop.campustour;

import android.content.Context;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

public class MapView extends FragmentActivity implements GoogleMap.OnMarkerClickListener, GoogleMap.OnMapClickListener {

    private GoogleMap mMap; // Might be null if Google Play services APK is not available.

    private Context curContext = this;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map_view);
        setUpMapIfNeeded();
    }

    @Override
    protected void onResume() {
        super.onResume();
        setUpMapIfNeeded();
    }

    /**
     * Sets up the map if it is possible to do so (i.e., the Google Play services APK is correctly
     * installed) and the map has not already been instantiated.. This will ensure that we only ever
     * call {@link #setUpMap()} once when {@link #mMap} is not null.
     * <p/>
     * If it isn't installed {@link SupportMapFragment} (and
     * {@link com.google.android.gms.maps.MapView MapView}) will show a prompt for the user to
     * install/update the Google Play services APK on their device.
     * <p/>
     * A user can return to this FragmentActivity after following the prompt and correctly
     * installing/updating/enabling the Google Play services. Since the FragmentActivity may not
     * have been completely destroyed during this process (it is likely that it would only be
     * stopped or paused), {@link #onCreate(Bundle)} may not be called again so we should call this
     * method in {@link #onResume()} to guarantee that it will be called.
     */
    private void setUpMapIfNeeded() {
        // Do a null check to confirm that we have not already instantiated the map.
        if (mMap == null) {
            // Try to obtain the map from the SupportMapFragment.
            mMap = ((SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map))
                    .getMap();
            // Check if we were successful in obtaining the map.
            if (mMap != null) {
                setUpMap();
                mMap.moveCamera( CameraUpdateFactory.newLatLngZoom(new LatLng(42.0255, -93.6465), 15.5f) );
                mMap.setOnMapClickListener(this);
                mMap.setOnMarkerClickListener(this);
            }
        }
    }

    @Override
    public boolean onMarkerClick(Marker marker) {
        Toast.makeText(curContext, marker.getTitle() + " was clicked.\nCoordinates:(" + marker.getPosition().latitude + "," + marker.getPosition().longitude + ")", Toast.LENGTH_LONG).show();
        return false;
    }

    @Override
    public void onMapClick(LatLng latLng) {
        Toast.makeText(curContext, "(" + latLng.latitude + "," + latLng.longitude + ")", Toast.LENGTH_LONG).show();
    }

    /**
     * This is where we can add markers or lines, add listeners or move the camera. In this case, we
     * just add a marker near Africa.
     * <p/>
     * This should only be called once and when we are sure that {@link #mMap} is not null.
     */
    private void setUpMap() {
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.0255, -93.6460)).title("Campanile"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(0, 0)).title("Marker"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.0255, -93.6460)).title("Campanile"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.026163, -93.648340)).title("Beardshear Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));

    }
}
