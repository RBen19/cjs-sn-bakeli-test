<script setup>
const props = defineProps({
  prenom: { type: String, default: '' },
  nom: { type: String, default: '' },
  size: { type: String, default: 'md' },
})

const initials = () => {
  const p = props.prenom?.[0] || ''
  const n = props.nom?.[0] || ''
  return (p + n).toUpperCase()
}

// Generate deterministic color from name
const colors = [
  'from-green-400 to-green-600',
  'from-blue-400 to-blue-600',
  'from-purple-400 to-purple-600',
  'from-orange-400 to-orange-600',
  'from-teal-400 to-teal-600',
  'from-pink-400 to-pink-600',
  'from-indigo-400 to-indigo-600',
  'from-yellow-400 to-yellow-600',
]

const colorClass = () => {
  const str = (props.prenom + props.nom)
  let hash = 0
  for (let i = 0; i < str.length; i++) hash = str.charCodeAt(i) + ((hash << 5) - hash)
  return colors[Math.abs(hash) % colors.length]
}

const sizeClass = {
  sm: 'w-8 h-8 text-xs',
  md: 'w-10 h-10 text-sm',
  lg: 'w-14 h-14 text-lg',
}
</script>

<template>
  <div
    :class="[sizeClass[size], 'rounded-full bg-gradient-to-br text-white flex items-center justify-center font-bold flex-shrink-0', colorClass()]"
  >
    {{ initials() }}
  </div>
</template>
