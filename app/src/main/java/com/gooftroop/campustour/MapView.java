package com.gooftroop.campustour;

import android.content.Context;
import android.graphics.Color;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.maps.model.PolylineOptions;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Set;

public class MapView extends FragmentActivity implements GoogleMap.OnMarkerClickListener, GoogleMap.OnMapClickListener {

    private GoogleMap mMap;

    private Context curContext = this;

    private boolean SHOW_BUILDING_BOUNDS = true;

    /**
     * Maintains a Master List of All Campus location and whether or not they have been visited
     */
    private HashMap<CampusLocation, Boolean> locations = new HashMap<CampusLocation, Boolean>();

    DetailPageAdapter pageAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main_activity_images_layout);

        List<Fragment> fragments = getFragments();

        pageAdapter = new DetailPageAdapter(getSupportFragmentManager(), fragments);

        ViewPager pager = (ViewPager) findViewById(R.id.viewpager);
        pager.setAdapter(pageAdapter);

        //Set the class used for changing the animation for sliding images on the bottom
        pager.setPageTransformer(true, new ZoomOutPageTransformer());

        locations.put(createCooverHall(), false);
        setUpMapIfNeeded();
    }

    private List<Fragment> getFragments() {
        List<Fragment> fList = new ArrayList<Fragment>();
        fList.add(LocationImagesFragment.newInstance(R.drawable.coover_1, "A classroom in Coover Hall."));
        fList.add(LocationImagesFragment.newInstance(R.drawable.coover_2, "Coover Hall was built in 1950."));
        fList.add(LocationImagesFragment.newInstance(R.drawable.coover_3, "Coover Hall is home to the Department of Electrical and Computer Engineering."));
        fList.add(LocationImagesFragment.newInstance(R.drawable.coover_4, "Coover Hall is home to many research laboratories."));
        fList.add(LocationImagesFragment.newInstance(R.drawable.coover_5, "A student lounge space located on the 2nd floor."));
        return fList;
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
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.0255, -93.6460)).title("Campanile"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.024220,-93.651840)).title("Helser Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.023917,-93.650437)).title("Friley Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.026163, -93.648340)).title("Beardshear Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.025429, -93.644472)).title("Gerdin Business Building"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.026183, -93.644851)).title("Curtiss Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.026593,-93.644199)).title("Ross Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.026880,-93.642579)).title("Food Sciences Building"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.027195, -93.644569)).title("Jischke Honors Building"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.026127, -93.643395)).title("East Hall"));
        
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.023616, -93.645924)).title("Memorial Union"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.027840,-93.644100)).title("Troxel Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.028486,-93.644637)).title("Bessey Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.028374, -93.645634)).title("Palmer Building"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.028598, -93.646525)).title("MacKay Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        //mMap.addMarker(new MarkerOptions().position(new LatLng(42.028358, -93.650738)).title("Coover Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.0285454, -93.647469)).title("LeBaron Hall"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.028103, -93.647554)).title("Human Nutritional Sciences Building"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.029602,-93.643874)).title("Kildee Hall/Meats Laboratory"));
        mMap.addMarker(new MarkerOptions().position(new LatLng(42.029195,-93.646342)).title("Science Hall"));
        

        Set<CampusLocation> locationList = locations.keySet();

        for (CampusLocation loc : locationList)
        {
            mMap.addMarker(new MarkerOptions().position(loc.getMarkerLocation()).title(loc.getName()));

            if(SHOW_BUILDING_BOUNDS)
            {
                List<LatLngBounds> bnds = loc.getBuildingBoundsList();

                for (LatLngBounds bnd : bnds)
                {
                    //mMap.addPolygon()
                    Polyline line = mMap.addPolyline(new PolylineOptions()
                            .add(bnd.northeast)
                            .add(new LatLng(bnd.southwest.latitude, bnd.northeast.longitude))
                            .add(bnd.southwest)
                            .add(new LatLng(bnd.northeast.latitude, bnd.southwest.longitude))
                            .add(bnd.northeast)
                            .width(2)
                            .color(Color.RED));
                }
            }
        }
    }

    private CampusLocation createCooverHall()
    {
        LatLngBounds.Builder bounds = LatLngBounds.builder();
        bounds.include(new LatLng(42.02808, -93.65027));  //Southeast corner
        bounds.include(new LatLng(42.028847, -93.65178)); //Northwest corner

        ArrayList<LatLngBounds> boundsList = new ArrayList<LatLngBounds>();
        boundsList.add(bounds.build());

        return new CampusLocation("Coover Hall", new LatLng(42.028358, -93.650738), boundsList);
    }

    class DetailPageAdapter extends FragmentPagerAdapter {

        private List<Fragment> fragments;

        public DetailPageAdapter (FragmentManager fm, List<Fragment> fragments) {
            super(fm);
            this.fragments = fragments;
        }

        @Override
        public Fragment getItem(int i) {
            return this.fragments.get(i);
        }

        @Override
        public int getCount() {
            return this.fragments.size();
        }
    }

}
