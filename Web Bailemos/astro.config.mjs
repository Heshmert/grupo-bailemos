import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';

import svelte from '@astrojs/svelte';

// https://astro.build/config
export default defineConfig({
  vite: {
    plugins: [tailwindcss()]
  },

  alias:{
    '@components': './src/components',
    '@layouts': './src/layouts',
    '@assets': './src/assets',
    '@lib': './src/lib'
  },

  integrations: [svelte()]
});