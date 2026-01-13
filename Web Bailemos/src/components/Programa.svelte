<script lang="ts">
  export let titulo: string;
  export let descripcion: string;
  export let imagen: string;
  export let resumen: string;
  export let galeria: string[] = []; // array de imágenes
  export let contenidos: string[] = []; // lista de contenidos

  let dialogRef: HTMLDialogElement;

  function abrirDialog() {
    dialogRef.showModal();
  }

  function cerrarDialog() {
    dialogRef.close();
  }
</script>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
  <!-- Imagen -->
  <img src={imagen} alt={titulo} class="w-full h-40 object-cover" />

  <!-- Contenido -->
  <div class="p-6 text-left">
    <h3 class="text-xl font-semibold text-[#3F2B67] mb-2">{titulo}</h3>
    <p class="text-sm text-[#331D2C] mb-4">{descripcion}</p>
    <button
      on:click={abrirDialog}
      class="bg-[#23E628] text-[#331D2C] font-semibold px-4 py-2 rounded hover:bg-[#2d9d1e] transition"
    >
      Ver más
    </button>
  </div>
</div>

<!-- Dialog extendido -->
<dialog bind:this={dialogRef} class="w-3/4 max-w-4xl rounded-lg shadow-xl overflow-auto m-auto">
  <!-- Franja superior -->
  <div class="bg-deep flex justify-between items-center px-6 py-3">
    <h2 class="text-white text-xl font-semibold">{titulo}</h2>
    <button on:click={cerrarDialog} class="text-white text-2xl font-bold hover:text-[#23E628]">×</button>
  </div>

  <!-- Contenido del diálogo -->
  <div class="p-6 space-y-6 text-left">
    <!-- Resumen -->
    <p class="text-gray-700 text-lg">{resumen}</p>

    <!-- Galería de imágenes -->
    {#if galeria.length > 0}
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        {#each galeria as img}
          <img src={img} alt="Galería {titulo}" class="w-full h-32 object-cover rounded" />
        {/each}
      </div>
    {/if}

    <!-- Lista de contenidos -->
    {#if contenidos.length > 0}
      <div class="bg-air rounded-lg p-6 mt-6">
        <h3 class="text-[#3F2B67] font-semibold mb-4">Contenidos del programa:</h3>
        
        <div class="grid grid-cols-1 gap-3">
          {#each contenidos as item}
            <div class="border border-green-300 rounded-md px-4 py-2 bg-white shadow-sm">
              {item}
            </div>
          {/each}
        </div>
      </div>
    {/if}

  </div>
</dialog>
