#!/usr/bin/env bash
# =============================================================================
# CSJ-SN Backend — Script d'installation
# Usage : bash install.sh
# =============================================================================

set -e

# ── Couleurs ──────────────────────────────────────────────────────────────────
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m'

ok()   { echo -e "${GREEN}✔${NC}  $1"; }
info() { echo -e "${CYAN}→${NC}  $1"; }
warn() { echo -e "${YELLOW}⚠${NC}  $1"; }
fail() { echo -e "${RED}✘${NC}  $1"; exit 1; }

# ── Bannière ──────────────────────────────────────────────────────────────────
echo ""
echo -e "${GREEN}${BOLD}"
echo "  ██████╗███████╗     ██╗    ███████╗███╗   ██╗"
echo " ██╔════╝██╔════╝     ██║    ██╔════╝████╗  ██║"
echo " ██║     ███████╗ ██╗ ██║    ███████╗██╔██╗ ██║"
echo " ██║     ╚════██║ ╚═╝ ██║    ╚════██║██║╚██╗██║"
echo " ╚██████╗███████║     ██║    ███████║██║ ╚████║"
echo "  ╚═════╝╚══════╝     ╚═╝    ╚══════╝╚═╝  ╚═══╝"
echo -e "${NC}"
echo -e "  ${BOLD}Consortium Jeunesse Sénégal — Installation Backend${NC}"
echo ""
echo -e "─────────────────────────────────────────────────────"
echo ""

# ── Vérifier les prérequis ────────────────────────────────────────────────────
info "Vérification des prérequis..."

command -v php  >/dev/null 2>&1 || fail "PHP n'est pas installé. Installez PHP >= 8.2"
command -v composer >/dev/null 2>&1 || fail "Composer n'est pas installé. Voir https://getcomposer.org"

PHP_VERSION=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
ok "PHP ${PHP_VERSION} détecté"
ok "Composer détecté"

# ── Vérifier extension pdo_mysql ─────────────────────────────────────────────
if php -m | grep -q pdo_mysql; then
  ok "Extension pdo_mysql active"
else
  warn "Extension pdo_mysql introuvable. Activez-la dans php.ini avant de migrer."
fi

echo ""

# ── Dépendances Composer ──────────────────────────────────────────────────────
info "Installation des dépendances Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader
ok "Dépendances installées"

echo ""

# ── Fichier .env ──────────────────────────────────────────────────────────────
if [ ! -f .env ]; then
  info "Copie de .env.example → .env"
  cp .env.example .env
  ok ".env créé"
else
  warn ".env déjà présent, conservé tel quel"
fi

echo ""

# ── Clé d'application ─────────────────────────────────────────────────────────
info "Génération de la clé d'application..."
php artisan key:generate --ansi
ok "APP_KEY générée"

echo ""

# ── Rappel base de données ────────────────────────────────────────────────────
echo -e "${YELLOW}${BOLD}⚠  Assurez-vous que la base de données MySQL existe déjà :${NC}"
echo -e "   ${CYAN}mysql -u root -e \"CREATE DATABASE IF NOT EXISTS csj_sn CHARACTER SET utf8mb4;\"${NC}"
echo -e "   Et que DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD sont corrects dans .env"
echo ""
read -rp "   Appuyez sur ENTRÉE pour continuer (ou Ctrl+C pour arrêter)... "
echo ""

# ── Migrations + Seeders ──────────────────────────────────────────────────────
info "Exécution des migrations et des seeders..."
php artisan migrate --seed --force
ok "Base de données initialisée (migrations + données de test)"

echo ""

# ── Cache de config ───────────────────────────────────────────────────────────
info "Optimisation de la configuration..."
php artisan config:clear
ok "Cache vidé"

echo ""
echo -e "─────────────────────────────────────────────────────"
echo -e "  ${GREEN}${BOLD}✔ Installation terminée !${NC}"
echo ""
echo -e "  ${BOLD}Identifiants de démo :${NC}"
echo -e "  Email    : ${CYAN}admin@csj-sn.org${NC}"
echo -e "  Mot de passe : ${CYAN}password${NC}"
echo ""

# ── Démarrer le serveur ───────────────────────────────────────────────────────
info "Démarrage du serveur sur http://localhost:8000 ..."
echo ""
php artisan serve
