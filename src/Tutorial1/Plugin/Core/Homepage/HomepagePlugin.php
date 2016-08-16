<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 16.08.16
     * Time: 09:54
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\Homepage;


    use Gismo\Component\Application\Context;
    use Gismo\Component\Plugin\Plugin;
    use Gismo\Tutorial\Tutorial1\Context\Homepage\HomepageContext;

    class HomepagePlugin implements Plugin {


        public function onContextInit(Context $context) {
            if ($context instanceof HomepageContext) {

                $context["page.mainLayout"][0] = $context->templateFile(__DIR__ . "/Tpl/MainLayout.tpl.html");

                $context->route->add("/", function () use ($context) {
                    echo $context["page.mainLayout"]();
                });

            }
        }
    }