<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 px-4 pt-4 pb-3" style="background: linear-gradient(135deg, rgba(25,135,84,.08), rgba(13,110,253,.06));">
                <div>
                    <h2 class="modal-title h4 fw-bold text-dark mb-0" id="roleModalLabel">Cambiar rol</h2>
                    <p class="text-muted mb-0">Selecciona el perfil para esta sesión.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <form id="roleForm" method="POST" action="{{ route('admin.switch-role') }}">
                    @csrf
                    <div class="role-options d-grid gap-2">
                        @php
                            $roleOptions = [
                            'admin' => ['Administrador', 'Acceso a las funciones administrativas', 'fa-crown'],
                            'teacher' => ['Instructor', 'Funciones orientadas a la formación', 'fa-chalkboard-user'],
                            'apprentice' => ['Aprendiz', 'Funciones para la comunidad de aprendices', 'fa-user-graduate'],
                            ];
                            if (auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true)) {
                                $roleOptions = array_intersect_key($roleOptions, ['teacher' => true, 'apprentice' => true]);
                            }
                        @endphp
                        @foreach ($roleOptions as $role => [$label, $description, $icon])
                            <label for="role-{{ $role }}" class="role-option d-flex align-items-center gap-3 p-3 rounded-3 border">
                                <input type="radio" id="role-{{ $role }}" name="role" value="{{ $role }}"
                                    @checked(auth()->check() ? auth()->user()->role === $role : $role === 'apprentice')>
                                <span class="role-icon"><i class="fas {{ $icon }}"></i></span>
                                <span>
                                    <strong class="d-block text-dark">{{ $label }}</strong>
                                    <small class="text-muted">{{ $description }}</small>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="roleForm" class="btn btn-success">
                    <i class="fas fa-check me-1"></i> Cambiar rol
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .role-option { cursor: pointer; transition: border-color .18s ease, background .18s ease; }
    .role-option:hover { border-color: #83bf8a !important; background: #f5fbf6; }
    .role-option input { accent-color: #198754; }
    .role-icon { align-items: center; background: #eaf5ee; border-radius: 50%; color: #198754; display: inline-flex; flex: 0 0 40px; height: 40px; justify-content: center; }
</style>

<script>
    function openRoleModal() {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('roleModal')).show();
    }
</script>
