package com.gooftroop.campustour;

import android.text.TextUtils;

import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;

import java.util.Arrays;
import java.util.List;

public class CampusLocation {

    private String name;

    private LatLng markerLocation;

    private List<LatLngBounds> buildingBoundsList;

    /**
     * Constructs a new Campus Location with the given name and buildingBounds
     * @param name The name of the campus location
     * @param markerLocation The LatLng object where the object marker should be located.
     * @param buildingBoundsList the list of LatLngBounds rectangles which define the bounds of the campus location
     */
    public CampusLocation(String name, LatLng markerLocation, List<LatLngBounds> buildingBoundsList)
    {
        if (TextUtils.isEmpty(name))
        {
            throw new IllegalArgumentException("Name should be filled in");
        }
        this.name = name;

        if (markerLocation == null)
        {
            throw new IllegalArgumentException("The LatLng object for marker location should not be null");
        }
        this.markerLocation = markerLocation;

        if (buildingBoundsList == null || buildingBoundsList.size() <= 0)
        {
            throw new IllegalArgumentException("You must specify a buildingBoundsList for this location.");
        }
        this.buildingBoundsList = buildingBoundsList;
    }

    public LatLng getMarkerLocation()
    {
        return markerLocation;
    }

    public String getName()
    {
        return name;
    }

    public List<LatLngBounds> getBuildingBoundsList()
    {
        return buildingBoundsList;
    }

    /**
     * Returns true if the given point is the bounds of the building
     * @param point - The LatLng point to check if it is within the bounds of the building.
     * @return
     */
    public boolean pointIsInBounds (LatLng point)
    {
        for (int i = 0; i<buildingBoundsList.size(); i++)
        {
            if (buildingBoundsList.get(i).contains(point))
            {
                return true;
            }
        }

        return false;
    }
}
