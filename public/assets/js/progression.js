// Dans votre fichier JavaScript (ou dans une balise <script>)
document.addEventListener('DOMContentLoaded', function() {
    // Écouteur pour les événements de progression (ex: clic sur "Marquer comme terminé")
    document.querySelectorAll('.mark-complete').forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.dataset.courseId;
            const newProgress = parseInt(this.dataset.progress);
            
            updateCourseProgress(courseId, newProgress);
        });
    });

    // Fonction pour mettre à jour la progression
    function updateCourseProgress(courseId, newProgress) {
        // Mise à jour visuelle immédiate
        const progressBar = document.querySelector(`.course-card[data-course-id="${courseId}"] .course-progress-indicator`);
        if (progressBar) {
            progressBar.style.width = `${newProgress}%`;
            progressBar.textContent = `${newProgress}%`; // Optionnel
        }

        // Envoi au serveur
        fetch(`/api/courses/${courseId}/progress`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ progress: newProgress })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Erreur de mise à jour');
                // Revenir à l'ancienne valeur si erreur
            }
        });
    }
});