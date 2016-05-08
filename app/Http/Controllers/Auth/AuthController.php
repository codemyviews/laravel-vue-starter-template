<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\ThrottlesLogins;
//use CMV\Repositories\Identity\UserRepository;
//use CMV\Repositories\Identity\TeamRepository;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * @todo add teams stuff or cleanup commented code
 * @Middleware("guest", except={"getLogout"})
 * Class AuthController
 * @package CMV\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

//    /**
//     * The user repository instance.
//     *
//     * @var UserRepository
//     */
//    protected $users;

//    /**
//     * The team repository instance.
//     *
//     * @var TeamRepository
//     */
//    protected $teams;

    /**
     * The URI for the login route.
     *
     * @var string
     */
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct(/* UserRepository $users, TeamRepository $teams */)
    {
//        $this->users = $users;
//        $this->teams = $teams;
    }

    /**
     * Show the application login form.
     *
     * @Get("login")
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('user.login');
    }

    /**
     * Send the post-authentication response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, Authenticatable $user)
    {
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Show the application registration form.
     *
     * @Get("register", as="user.register")
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getRegister(Request $request)
    {
        return view('user.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @Post("register")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'terms' => 'required|accepted',
        ]);

//        $user = $this->users->createUserFromRegistrationRequest($request);
//
//        if ($request->team_name) {
//            $team = $this->teams->create($user, ['name' => $request->team_name]);
//        }
//
//        if ($request->invitation) {
//            $this->teams->attachUserToTeamByInvitation($request->invitation, $user);
//        }

//        Auth::login($user);

        return response()->json(['path' => $this->redirectPath()]);
    }

    /**
     * Log the user out of the application.
     *
     * @Get("logout")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * @Post("login")
     * @param Request $request
     * @return Response
     */
    public function loginPost(Request $request)
    {
        return $this->postLogin($request);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return getHomeLink();
    }
}
