<?php

namespace App\Http\Controllers;

class StaffController extends Controller {

    /**
     * Get staff
     *
     * @return void
     */
    public function getStaff() {
        $staff = [
            "FOUNDER" => [
                [
                    'uuid' => "ba4161c03a42496c8ae07d13372f3371",
                    'username' => "james090500",
                    'bio' => "Cillum laborum consequat do laborum ipsum duis elit veniam elit voluptate. Non proident minim duis adipisicing proident adipisicing. Ut proident ex Lorem eiusmod qui quis do elit tempor magna. Voluptate duis eu nulla aliquip laborum ea eu dolore deserunt Lorem dolore culpa quis. Aute non deserunt non excepteur. Enim ex et tempor tempor non. Anim sunt occaecat enim nisi cupidatat in tempor in duis non."
                ]
            ],
            "ADMIN" => [
                [
                    'uuid' => "bf8b08a5714c46678f49efce56cb7dc5",
                    'username' => "mov51",
                    'bio' => "Cillum laborum consequat do laborum ipsum duis elit veniam elit voluptate. Non proident minim duis adipisicing proident adipisicing. Ut proident ex Lorem eiusmod qui quis do elit tempor magna. Voluptate duis eu nulla aliquip laborum ea eu dolore deserunt Lorem dolore culpa quis. Aute non deserunt non excepteur. Enim ex et tempor tempor non. Anim sunt occaecat enim nisi cupidatat in tempor in duis non."
                ],
                [
                    'uuid' => "58f1a83b425d4844823ffa04a201facd",
                    'username' => "MiniPixie",
                    'bio' => "Cillum laborum consequat do laborum ipsum duis elit veniam elit voluptate. Non proident minim duis adipisicing proident adipisicing. Ut proident ex Lorem eiusmod qui quis do elit tempor magna. Voluptate duis eu nulla aliquip laborum ea eu dolore deserunt Lorem dolore culpa quis. Aute non deserunt non excepteur. Enim ex et tempor tempor non. Anim sunt occaecat enim nisi cupidatat in tempor in duis non."
                ],
            ],
            "MOD" => [
                [
                    'uuid' => "eac175df75be4beaa41b511a9eff53dc",
                    'username' => "_iOminous_",
                    'bio' => "Cillum laborum consequat do laborum ipsum duis elit veniam elit voluptate. Non proident minim duis adipisicing proident adipisicing. Ut proident ex Lorem eiusmod qui quis do elit tempor magna. Voluptate duis eu nulla aliquip laborum ea eu dolore deserunt Lorem dolore culpa quis. Aute non deserunt non excepteur. Enim ex et tempor tempor non. Anim sunt occaecat enim nisi cupidatat in tempor in duis non."
                ],
                [
                    'uuid' => "3a65126e5d3a406d851a6c0d8884bcee",
                    'username' => "vonBek71",
                    'bio' => "Cillum laborum consequat do laborum ipsum duis elit veniam elit voluptate. Non proident minim duis adipisicing proident adipisicing. Ut proident ex Lorem eiusmod qui quis do elit tempor magna. Voluptate duis eu nulla aliquip laborum ea eu dolore deserunt Lorem dolore culpa quis. Aute non deserunt non excepteur. Enim ex et tempor tempor non. Anim sunt occaecat enim nisi cupidatat in tempor in duis non."
                ],
                [
                    'uuid' => "4f48a59283cc48c9bf51d72bba50c943",
                    'username' => "BadLuckPanda644",
                    'bio' => "Cillum laborum consequat do laborum ipsum duis elit veniam elit voluptate. Non proident minim duis adipisicing proident adipisicing. Ut proident ex Lorem eiusmod qui quis do elit tempor magna. Voluptate duis eu nulla aliquip laborum ea eu dolore deserunt Lorem dolore culpa quis. Aute non deserunt non excepteur. Enim ex et tempor tempor non. Anim sunt occaecat enim nisi cupidatat in tempor in duis non."
                ],
            ]
        ];
        return response()->json($staff);
    }

}
