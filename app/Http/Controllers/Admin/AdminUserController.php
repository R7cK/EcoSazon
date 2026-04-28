namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        return view('Admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'role' => 'required|in:user,owner,admin',
            'name' => 'required|string|max:255'
        ]);
        $user->update($request->only('name', 'role'));
        return back()->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $user) {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }
        $user->delete();
        return back()->with('success', 'Usuario eliminado.');
    }
}