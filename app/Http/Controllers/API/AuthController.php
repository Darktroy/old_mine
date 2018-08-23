<?php
    namespace App\Http\Controllers\API;
    
    use Illuminate\Http\Request; 
    use App\Http\Controllers\Controller; 
    use Illuminate\Support\Facades\Auth; 
    use App\User; 
    use Validator;
    
    class AuthController extends Controller 
    {
      /** 
       * Login API 
       * 
       * @return \Illuminate\Http\Response 
       */ 
      public function login(Request $request){ 
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
          $user = Auth::user(); 
          $success['token'] =  $user->createToken('LaraPassport')->accessToken; 
          return response()->json([
            'UserDetails' =>  $user,
            'status' => 'success',
            'data' => $success
          ]); 
        } else { 
          return response()->json([
            'status' => 'error',
            'data' => 'Unauthorized Access'
          ]); 
        } 
      }
        
      public function loginMobile(Request $request){ 
        if(Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])){ 
          $user = Auth::user(); 
          $success['token'] =  $user->createToken('LaraPassport')->accessToken; 
          return response()->json([
            'UserDetails' =>  $user,
            'status' => 'success',
            'data' => $success
          ]); 
        } else { 
          return response()->json([
            'status' => 'error',
            'data' => 'Unauthorized Access'
          ]); 
        } 
      }
      
      /** 
       * Register API 
       * 
       * @return \Illuminate\Http\Response 
       */ 
      public function register(Request $request) 
      { 
//          dd(587);
        $validator = Validator::make($request->all(), [ 
          'name' => 'required', 
          'email' => 'required|email', 
          'password' => 'required', 
          'c_password' => 'required|same:password', 
          'lang' => 'required|string|min:2|max:2', 
        ]);
        if ($validator->fails()) { 
          return response()->json(['error'=>$validator->errors()]);
        }
        $postArray = $request->all(); 
        $postArray['password'] = bcrypt($postArray['password']); 
        $user = User::create($postArray); 
        $success['token'] =  $user->createToken('LaraPassport')->accessToken; 
        $success['name'] =  $user->name;
        return response()->json([
            'UserDetails' =>  $user,
          'status' => 'success',
          'data' => $success,
        ]); 
      }
      
      public function registerMobile(Request $request) 
      { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
            'mobile' => 'required|unique:users|min:11|max:11',
            'lang' => 'required|string|size:2', 
        ]);
        if ($validator->fails()) { 
          return response()->json([
          'status' => 'error','error'=>$validator->errors()]);
        }
        $postArray = $request->all(); 
        $postArray['password'] = bcrypt($postArray['password']); 
        $user = User::create($postArray); 
//        $success['UserDetails'] =  $user;
        $success['token'] =  $user->createToken('LaraPassport')->accessToken; 
        $success['name'] =  $user->name;
        return response()->json([
        'UserDetails' =>  $user,
          'status' => 'success',
          'data' => $success,
        ]); 
      }
        
      /** 
       * details api 
       * 
       * @return \Illuminate\Http\Response 
       */ 
      public function getDetails() 
      { 
        $user = Auth::user(); 
        return response()->json(['success' => $user]); 
      } 
    }