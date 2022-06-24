<?php
namespace app\commands;

use app\rbac\UpdateOwnLabelDesigner;
use app\rbac\UpdateOwnLabelManager;
use app\rbac\AllowToPrepressReadyRule;
use app\rbac\AllowToDesignReadyRule;
use app\rbac\AllowToFlexformReadyRule;
use app\rbac\AllowToEditShipment;
use app\rbac\AllowToEditOrder;
use app\rbac\AllowToEditCustomer;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "list_of_orders"
        /*$permit_to_manager = $auth->createPermission('permit_to_manager');
        $permit_to_manager->description = 'list of orders';
        $auth->add($permit_to_manager);*/
        $labelOwnerDesigner = new UpdateOwnLabelDesigner();
        $auth->add($labelOwnerDesigner);

        $shipmentOwnerManager = new AllowToEditShipment();
        $auth->add($shipmentOwnerManager);

        $allowToEditOrder = new AllowToEditOrder();
        $auth->add($allowToEditOrder);

        $allowToEditCustomer = new AllowToEditCustomer();
        $auth->add($allowToEditCustomer);

        $labelOwnerManager = new UpdateOwnLabelManager();
        $auth->add($labelOwnerManager);

        $labelinprepress = new AllowToPrepressReadyRule();
        $auth->add($labelinprepress);

        $labelindesign = new AllowToDesignReadyRule();
        $auth->add($labelindesign);

        $labelinlaboratory = new AllowToFlexformReadyRule();
        $auth->add($labelinlaboratory);

        $updateOwnLabelDesigner = $auth->createPermission('updateOwnLabelDesigner');
        $updateOwnLabelDesigner->description = 'Update own label by designer';
        $updateOwnLabelDesigner->ruleName = $labelOwnerDesigner->name;
        $auth->add($updateOwnLabelDesigner);

        $updateOwnShipmentManager = $auth->createPermission('updateOwnShipmentManager');
        $updateOwnShipmentManager->description = 'Update own shipment by manager';
        $updateOwnShipmentManager->ruleName = $shipmentOwnerManager->name;
        $auth->add($updateOwnShipmentManager);

        $updateOwnCustomerManager = $auth->createPermission('updateOwnCustomerManager');
        $updateOwnCustomerManager->description = 'updateOwnCustomerManager';
        $updateOwnCustomerManager->ruleName = $allowToEditCustomer->name;
        $auth->add($updateOwnCustomerManager);

        $updateOwnOrderManager = $auth->createPermission('updateOwnOrderManager');
        $updateOwnOrderManager->description = 'Update own order by manager';
        $updateOwnOrderManager->ruleName = $allowToEditOrder->name;
        $auth->add($updateOwnOrderManager);

        $allowToFlexformReadyRule = $auth->createPermission('allowToFlexformReadyRule');
        $allowToFlexformReadyRule->description = 'Update own label by designer';
        $allowToFlexformReadyRule->ruleName = $labelinlaboratory->name;
        $auth->add($allowToFlexformReadyRule);

        $updateOwnLabelManager = $auth->createPermission('updateOwnLabelManager');
        $updateOwnLabelManager->description = 'Update own label by manager';
        $updateOwnLabelManager->ruleName = $labelOwnerManager->name;
        $auth->add($updateOwnLabelManager);

        $allowToPrepressReadyRule = $auth->createPermission('allowToPrepressReadyRule');
        $allowToPrepressReadyRule->description = 'prepress ready if it in prepress';
        $allowToPrepressReadyRule->ruleName = $labelinprepress->name;
        $auth->add($allowToPrepressReadyRule);

        $allowToDesignReadyRule = $auth->createPermission('allowToDesignReadyRule');
        $allowToDesignReadyRule->description = 'design ready if it in design';
        $allowToDesignReadyRule->ruleName = $labelindesign->name;
        $auth->add($allowToDesignReadyRule);

        // добавляем роль "manager" и даём роли разрешение "list"		
		$manager = $auth->createRole('manager');
		$logistician = $auth->createRole('logistician');
		$rewinder = $auth->createRole('rewinder');
        $packer = $auth->createRole('packer');
		$laboratory = $auth->createRole('laboratory');
		$prepress = $auth->createRole('prepress');
		$designer_admin = $auth->createRole('designer_admin');
        //$auth->addChild($manager, $permit_to_manager);
        $designer = $auth->createRole('designer');
        $printer = $auth->createRole('printer');
        $manager_admin = $auth->createRole('manager_admin');
        $admin = $auth->createRole('admin');
        $auth->add($designer);
        $auth->add($logistician);
        $auth->add($packer);
        $auth->add($rewinder);
        $auth->add($printer);
        $auth->add($prepress);
        $auth->add($laboratory);
        $auth->add($designer_admin);
        $auth->add($manager);
        $auth->add($manager_admin);
        $auth->add($admin);
        // добавляем роль "admin" и даём роли разрешение "list"
        //$auth->addChild($admin, $permit_to_manager);
//        $auth->addChild($updateOwnLabel,$updateLabel);
//        $auth->addChild($updateOwnLabelDesigner,$);
        $auth->addChild($designer,$updateOwnLabelDesigner);
        $auth->addChild($designer,$allowToDesignReadyRule);
        $auth->addChild($laboratory,$allowToFlexformReadyRule);
        $auth->addChild($manager,$updateOwnLabelManager);
        $auth->addChild($manager,$updateOwnShipmentManager);
        $auth->addChild($manager,$updateOwnCustomerManager);
        $auth->addChild($manager,$updateOwnOrderManager);
        $auth->addChild($prepress,$allowToPrepressReadyRule);
        $auth->addChild($designer_admin,$designer);
        $auth->addChild($designer_admin,$prepress);
        $auth->addChild($manager_admin,$manager);
        $auth->addChild($admin, $designer_admin);
        $auth->addChild($admin, $logistician);
        $auth->addChild($admin, $rewinder);
        $auth->addChild($admin, $packer);
        $auth->addChild($admin, $manager_admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $laboratory);
        $auth->addChild($admin, $designer);
        $auth->addChild($admin, $printer);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
//		$auth->assign($manager, 102);
//		$auth->assign($designer, 104);
		$auth->assign($printer, 108);
		$auth->assign($packer, 110);
		$auth->assign($logistician, 110);
		$auth->assign($rewinder, 109);
		$auth->assign($designer, 105);
		$auth->assign($designer, 107);
		$auth->assign($prepress, 101);
		$auth->assign($laboratory, 106);
        $auth->assign($manager, 103);
        $auth->assign($manager_admin, 102);
        $auth->assign($designer_admin, 104);
        $auth->assign($admin, 100);
    }
}