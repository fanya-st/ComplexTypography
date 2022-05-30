<?php
namespace app\commands;

use app\rbac\UpdateOwnLabel;
use app\rbac\PrepressOwnLabel;
use app\rbac\UseOwnLabelByManager;
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
        $labelOwner = new UpdateOwnLabel();
        $auth->add($labelOwner);
        $labelPrepressOwner = new PrepressOwnLabel();
        $auth->add($labelPrepressOwner);
        $labelManagerOwner = new UseOwnLabelByManager();
        $auth->add($labelManagerOwner);

        $updateOwnLabel = $auth->createPermission('updateOwnLabel');
        $updateOwnLabel->description = 'Update own label';
        $updateOwnLabel->ruleName = $labelOwner->name;
        $auth->add($updateOwnLabel);

        $useOwnLabelByManager = $auth->createPermission('useOwnLabelByManager');
        $useOwnLabelByManager->description = 'useOwnLabelByManager';
        $useOwnLabelByManager->ruleName = $labelManagerOwner->name;
        $auth->add($useOwnLabelByManager);

        $prepressOwnLabel = $auth->createPermission('prepressOwnLabel');
        $prepressOwnLabel->description = 'prepress own label';
        $prepressOwnLabel->ruleName = $labelPrepressOwner->name;
        $auth->add($prepressOwnLabel);

        // добавляем роль "manager" и даём роли разрешение "list"		
		$manager = $auth->createRole('manager');
		$prepress = $auth->createRole('prepress');
		$designer_admin = $auth->createRole('designer_admin');
        //$auth->addChild($manager, $permit_to_manager);
        $designer = $auth->createRole('designer');
        $manager_admin = $auth->createRole('manager_admin');
        $admin = $auth->createRole('admin');
        $auth->add($designer);
        $auth->add($prepress);
        $auth->add($designer_admin);
        $auth->add($manager);
        $auth->add($manager_admin);
        $auth->add($admin);
        // добавляем роль "admin" и даём роли разрешение "list"
        //$auth->addChild($admin, $permit_to_manager);
//        $auth->addChild($updateOwnLabel,$updateLabel);
        $auth->addChild($designer,$updateOwnLabel);
        $auth->addChild($prepress,$prepressOwnLabel);
        $auth->addChild($designer_admin,$designer);
        $auth->addChild($designer_admin,$prepress);
        $auth->addChild($manager_admin,$manager);
        $auth->addChild($manager,$useOwnLabelByManager);
        $auth->addChild($admin, $designer_admin);
        $auth->addChild($admin, $manager_admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $designer);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
//		$auth->assign($manager, 102);
//		$auth->assign($designer, 104);
		$auth->assign($designer, 105);
		$auth->assign($prepress, 101);
        $auth->assign($manager, 103);
        $auth->assign($manager_admin, 102);
        $auth->assign($designer_admin, 104);
        $auth->assign($admin, 100);
    }
}