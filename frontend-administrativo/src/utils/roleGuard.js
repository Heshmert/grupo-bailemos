// src/utils/roleGuard.js
export function checkAccess(allowedRoles) {
  if (typeof window !== 'undefined') {
    const role = localStorage.getItem('role');
    const token = localStorage.getItem('token');

    console.log("Guard check - Role en storage:", role, "Token existe:", !!token);

    // Si no hay token, fuera.
    if (!token) {
      console.warn("Acceso denegado: No hay token.");
      window.location.href = '/';
      return;
    }

    // Comparamos siempre como String para evitar errores de tipo
    const hasAccess = allowedRoles.map(String).includes(String(role));

    if (!hasAccess) {
      console.warn("Acceso denegado: Rol insuficiente.");
      
      // Redirección forzada según el rol que SÍ tiene
      if (String(role) === '1') window.location.href = '/dashboard/directivo';
      else if (String(role) === '2') window.location.href = '/dashboard/instructor';
      else window.location.href = '/';
    }
  }
}