<?php
namespace app\commands;

use app\rbac\UpdateOwnLabelDesigner;
use app\rbac\UpdateOwnLabelManager;
use app\rbac\AllowToPrepressReadyRule;
use app\rbac\AllowToDesignReadyRule;
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

        $labelOwnerManager = new UpdateOwnLabelManager();
        $auth->add($labelOwnerManager);

        $labelinprepress = new AllowToPrepressReadyRule();
        $auth->add($labelinprepress);

        $labelindesign = new AllowToDesignReadyRule();
        $auth->add($labelindesign);

        $updateOwnLabelDesigner = $auth->createPermission('updateOwnLabelDesigner');
        $updateOwnLabelDesigner->description = 'Update own label by designer';
        $updateOwnLabelDesigner->ruleName = $labelOwnerDesigner->name;
        $auth->add($updateOwnLabelDesigner);

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
		$laboratory = $auth->createRole('laboratory');
		$prepress = $auth->createRole('prepress');
		$designer_admin = $auth->createRole('designer_admin');
        //$auth->addChild($manager, $permit_to_manager);
        $designer = $auth->createRole('designer');
        $manager_admin = $auth->createRole('manager_admin');
        $admin = $auth->createRole('admin');
        $auth->add($designer);
        $auth->add($prepress);
        $auth->add($laboratory);
        $auth->add($designer_admin);
        $auth->add($manager);
        $auth->add($manager_admin);
        $auth->add($admin);
        // добавляем роль "admin" и даём роли разрешение "list"
        //$auth->addChild($admin, $permit_to_manager);
//        $auth->addChild($updateOwnLabel,$updateLabel);
        $auth->addChild($updateOwnLabelDesigner,$allowToDesignReadyRule);
        $auth->addChild($designer,$updateOwnLabelDesigner);
        $auth->addChild($manager,$updateOwnLabelManager);
        $auth->addChild($prepress,$allowToPrepressReadyRule);
        $auth->addChild($designer_admin,$designer);
        $auth->addChild($designer_admin,$prepress);
        $auth->addChild($manager_admin,$manager);
        $auth->addChild($admin, $designer_admin);
        $auth->addChild($admin, $manager_admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $laboratory);
        $auth->addChild($admin, $designer);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
//		$auth->assign($manager, 102);
//		$auth->assign($designer, 104);
		$auth->assign($designer, 105);
		$auth->assign($prepress, 101);
		$auth->assign($laboratory, 106);
        $auth->assign($manager, 103);
        $auth->assign($manager_admin, 102);
        $auth->assign($designer_admin, 104);
        $auth->assign($admin, 100);
    }
}