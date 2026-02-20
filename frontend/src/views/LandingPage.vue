<script setup>
import NavBar from '../components/landing/NavBar.vue'
import HeroSection from '../components/landing/HeroSection.vue'
import FeaturesSection from '../components/landing/FeaturesSection.vue'
import AboutSection from '../components/landing/AboutSection.vue'
import CTASection from '../components/landing/CTASection.vue'
import FooterSection from '../components/landing/FooterSection.vue'
</script>

<template>
  <div class="min-h-screen">
    <NavBar />
    <main>
      <HeroSection />
      <FeaturesSection />
      <AboutSection />
      <CTASection />
    </main>
    <FooterSection />
  </div>
</template>
