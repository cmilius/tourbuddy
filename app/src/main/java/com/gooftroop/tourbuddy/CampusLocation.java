package com.gooftroop.tourbuddy;

import android.location.Location;
import android.text.TextUtils;

import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;

import java.util.Arrays;
import java.util.List;

public class CampusLocation {

    private int id;

    private String name;

    private LatLng markerLocation;

    private List<LatLngBounds> buildingBoundsList;

    private String backgroundInfo;

    private List<Integer> imagesList;

    private List<String> imageDescriptionList;

    private boolean visited;

    /**
     *
     * @param id
     * @param name
     * @param markerLocation
     * @param buildingBoundsList
     * @param backgroundInfo
     * @param imagesList
     * @param imageDescriptionList
     * @param visited
     */
    public CampusLocation(int id, String name, LatLng markerLocation, List<LatLngBounds> buildingBoundsList, String backgroundInfo, List<Integer> imagesList, List<String> imageDescriptionList, boolean visited)
    {
        this.id = id;

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

        if (backgroundInfo == null)
        {
            throw new IllegalArgumentException("Background info should not be null");
        }
        this.backgroundInfo = backgroundInfo;


        if (imageDescriptionList == null)
        {
            throw new IllegalArgumentException("Images List Should not be null");
        }

        if (imagesList == null)
        {
            throw new IllegalArgumentException("Images List Should not be null");
        }

        if (imagesList.size() == 0 || (imagesList.size() != imageDescriptionList.size()))
        {
            throw new IllegalArgumentException("You must specify an images and images description list of the same size");
        }

        this.imagesList = imagesList;

        this.imageDescriptionList = imageDescriptionList;
    }

    public int getId()
    {
        return id;
    }

    public String getName()
    {
        return name;
    }

    public LatLng getMarkerLocation()
    {
        return markerLocation;
    }

    public List<LatLngBounds> getBuildingBoundsList()
    {
        return buildingBoundsList;
    }

    public String getBackgroundInfo()
    {
        return backgroundInfo;
    }

    public List<Integer> getImagesList()
    {
        return imagesList;
    }

    public List<String> getImageDescriptionList()
    {
        return imageDescriptionList;
    }

    public boolean getVisited()
    {
        return visited;
    }

    /**
     * Returns true if the given LatLng point is the bounds of the building
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
