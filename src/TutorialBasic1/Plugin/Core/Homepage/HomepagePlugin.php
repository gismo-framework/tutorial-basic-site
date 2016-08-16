<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 16.08.16
     * Time: 09:54
     */

    namespace Gismo\TutorialBasic1\Plugin\Core\Homepage;


    use Gismo\Component\Application\Context;
    use Gismo\Component\Di\DiCallChain;
    use Gismo\Component\HttpFoundation\Request\Request;
    use Gismo\Component\Plugin\Plugin;
    use Gismo\TutorialBasic1\Context\Homepage\HomepageContext;

    class HomepagePlugin implements Plugin {


        public function onContextInit(Context $context) {
            if ($context instanceof HomepageContext) {

                $context["page.mainLayout"][0] = $context->templateFile(__DIR__ . "/Tpl/MainLayout.tpl.html");


                /* Don't do that:
                $context["api.product.get"][0] = function ($id) {
                    return ["Some" => "data for $id"];
                };


                $context["api.product.get"][-1] = function ($§§return) {
                    $§§return["otherData"] =  "Filtermich";
                    return $§§return;
                };
                * Always use filter():
                */

                $context["api.product.get"] = $context->filter(function (DiCallChain $§§input) {
                    $§§input[0] = function ($id) {
                        return ["Some" => "data for $id"];
                    };
                });

                $context["api.product.get"] = $context->filter(function (DiCallChain $§§input) {
                    $§§input[-1] = function ($§§return, $id) {
                        $§§return["Some other"] = "data for $id";
                        return $§§return;
                    };
                });


                $context->route->add("GET@/api/product/:id", function ($§§parameters, Request $request) use ($context) {


                    $ret = $context["api.product.get"]($§§parameters);
                    echo json_encode($ret);

                });


                $context->route->add("/", function () use ($context) {
                    echo $context["page.mainLayout"](["title" => "Ein toller Titel"]);
                });

            }
        }
    }