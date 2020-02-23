<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\Helpers\MojangAPI;

  class StaffController extends Controller {

    /**
     * Shows the staff page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getStaff($request, $response, $args) {
      $staff = [
        'ba4161c03a42496c8ae07d13372f3371' => MojangAPI::getUsername('ba4161c03a42496c8ae07d13372f3371'),
        'bf8b08a5714c46678f49efce56cb7dc5' => MojangAPI::getUsername('bf8b08a5714c46678f49efce56cb7dc5'),
        '58f1a83b425d4844823ffa04a201facd' => MojangAPI::getUsername('58f1a83b425d4844823ffa04a201facd'),
        '86ddbc979d9247f0a7ed0c1f328f0b11' => MojangAPI::getUsername('86ddbc979d9247f0a7ed0c1f328f0b11'),
        '2d9a1bcaf032481e9da6c44f0cfab908' => MojangAPI::getUsername('2d9a1bcaf032481e9da6c44f0cfab908'),
        'c38ca4b68e3241e1a47850c1281e97c1' => MojangAPI::getUsername('c38ca4b68e3241e1a47850c1281e97c1')
      ];

      return self::getView()->render($response, 'Pages/staff.twig', [
        'staff' => $staff
      ]);
    }

  }
