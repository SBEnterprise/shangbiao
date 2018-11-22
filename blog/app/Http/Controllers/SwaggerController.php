<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Swagger\Annotations as SWG;

class SwaggerController extends Controller
{

  /**
* @SWG\Swagger(
*     schemes={"http","https"},
*     host="api.host.com",
*     basePath="/",
*     @SWG\Info(
*         version="1.0.0",
*         title="This is my website cool API",
*         description="Api description...",
*         termsOfService="",
*         @SWG\Contact(
*             email="contact@mysite.com"
*         ),
*         @SWG\License(
*             name="Private License",
*             url="URL to the license"
*         )
*     ),
*     @SWG\ExternalDocumentation(
*         description="Find out more about my website",
*         url="http..."
*     ),

*      // define tag

*     @SWG\Tag(name="Home", description="Roote Route"),
*     @SWG\Tag(name="User", description="UserController"),
*     @SWG\Tag(name="Role", description="RoleController"),
*     @SWG\ExternalDocumentation(
*         description="Find out more about my website",
*         url="http..."
*     ),
*    @SWG\Definition(
*       definition="errorModel",
*       required={"status code", "message"},
*       @SWG\Property(
*           property="status code",
*           type="integer",
*           format="int32"
*       ),
*       @SWG\Property(
*           property="message",
*           type="string"
*       )
*   ),

*    // 定义 API
*   @SWG\Definition(
*     definition="Login",
*      @SWG\Property(
*        property="useraccount",
*        type="string"
*      ),
*      @SWG\Property(
*         property="password",
*         type="string"
*      )
*    ),
*    @SWG\Definition(
*       definition="logout",
*       @SWG\Property(
*           property="token",
*           type="string"
*       )
*   ),
* )
*/



class SwaggerController extends Controller

{

public function doc()

{

$swagger = \Swagger\scan(realpath(__DIR__.’/../../’));

return response()->json($swagger);

}

}
}
