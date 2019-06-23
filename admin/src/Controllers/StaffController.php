<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\Helpers\MojangAPI;

  class StaffController extends Controller {

    public static function getStaff($request, $response, $args) {
      $staff = [
        'ba4161c03a42496c8ae07d13372f3371' => MojangAPI::getUsername('ba4161c03a42496c8ae07d13372f3371'),
        '617687afc8a846978e5c3ed53b7a335f' => MojangAPI::getUsername('617687afc8a846978e5c3ed53b7a335f'),
        'bf8b08a5714c46678f49efce56cb7dc5' => MojangAPI::getUsername('bf8b08a5714c46678f49efce56cb7dc5'),
        '58f1a83b425d4844823ffa04a201facd' => MojangAPI::getUsername('58f1a83b425d4844823ffa04a201facd'),
        '1c1e62b7fec14effa4dc9d3b97f6ded6' => MojangAPI::getUsername('1c1e62b7fec14effa4dc9d3b97f6ded6')
      ];

      return self::getView()->render($response, 'Pages/staff.twig', [
        'staff' => $staff
      ]);
    }

  }
