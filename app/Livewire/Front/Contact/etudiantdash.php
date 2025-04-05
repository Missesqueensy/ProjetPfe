namespace App\Http\Livewire;
<?php
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class StudentDashboard extends Component
{
    public $user;
    public $progress;

    public function mount()
    {
        // Récupérer l'utilisateur connecté
        $this->user = Auth::user();

        // Simuler la récupération du progrès (Remplace ça par une vraie requête)
        $this->progress = $this->user ? $this->user->progress : 0;
    }

    public function render()
    {
        return view('livewire.student-dashboard', [
            'user' => $this->user,
            'progress' => $this->progress
        ]);
    }
}
?>