// Very small i18n helper (no external dependency)
// Usage: const { t, locale } = useI18n();  t('nav.vehicles')

import { computed, inject } from 'vue';
import { usePage } from '@inertiajs/vue3';

const I18N_KEY = Symbol('i18n');

const messages = {
    es: {
        app: { name: 'Concesionario' },
        nav: {
            home: 'Inicio',
            vehicles: 'Vehículos',
            dashboard: 'Panel',
            login: 'Iniciar sesión',
            register: 'Registrarse',
            logout: 'Salir',
            profile: 'Perfil',
        },
        welcome: {
            title: 'Encuentra tu próximo vehículo',
            subtitle: 'Coches y motos revisados, con precio claro y compra sencilla.',
            ctaBrowse: 'Ver vehículos',
            ctaLogin: 'Entrar',
            ctaRegister: 'Crear cuenta',
            featuresTitle: 'Por qué comprar aquí',
            feature1: 'Stock actualizado en tiempo real',
            feature2: 'Compra segura con tu cuenta',
            feature3: 'Filtros por tipo y búsqueda',
        },
        vehicles: {
            title: 'Vehículos en venta',
            searchPlaceholder: 'Buscar por marca o modelo…',
            filterAll: 'Todos',
            filterCars: 'Coches',
            filterMotos: 'Motos',
            table: {
                type: 'Tipo',
                brand: 'Marca',
                model: 'Modelo',
                year: 'Año',
                mileage: 'Km',
                fuel: 'Combustible',
                price: 'Precio',
                actions: 'Acciones',
            },
            buy: 'Comprar',
            loginToBuy: 'Inicia sesión para comprar',
            purchasedOk: 'Compra registrada. ¡Gracias!',
            car: 'Coche',
            motorcycle: 'Moto',
        },
    },
    en: {
        app: { name: 'Dealership' },
        nav: {
            home: 'Home',
            vehicles: 'Vehicles',
            dashboard: 'Dashboard',
            login: 'Log in',
            register: 'Register',
            logout: 'Log out',
            profile: 'Profile',
        },
        welcome: {
            title: 'Find your next vehicle',
            subtitle: 'Cars and motorcycles, clear pricing, and a simple buying flow.',
            ctaBrowse: 'Browse vehicles',
            ctaLogin: 'Log in',
            ctaRegister: 'Create account',
            featuresTitle: 'Why buy here',
            feature1: 'Real-time inventory',
            feature2: 'Secure purchase with your account',
            feature3: 'Type filters and search',
        },
        vehicles: {
            title: 'Vehicles for sale',
            searchPlaceholder: 'Search by brand or model…',
            filterAll: 'All',
            filterCars: 'Cars',
            filterMotos: 'Motorcycles',
            table: {
                type: 'Type',
                brand: 'Brand',
                model: 'Model',
                year: 'Year',
                mileage: 'Km',
                fuel: 'Fuel',
                price: 'Price',
                actions: 'Actions',
            },
            buy: 'Buy',
            loginToBuy: 'Log in to buy',
            purchasedOk: 'Purchase saved. Thank you!',
            car: 'Car',
            motorcycle: 'Motorcycle',
        },
    },
    fr: {
        app: { name: 'Concessionnaire' },
        nav: {
            home: 'Accueil',
            vehicles: 'Véhicules',
            dashboard: 'Tableau de bord',
            login: 'Connexion',
            register: "S'inscrire",
            logout: 'Déconnexion',
            profile: 'Profil',
        },
        welcome: {
            title: 'Trouvez votre prochain véhicule',
            subtitle: 'Voitures et motos, prix clair, achat simple.',
            ctaBrowse: 'Voir les véhicules',
            ctaLogin: 'Se connecter',
            ctaRegister: 'Créer un compte',
            featuresTitle: "Pourquoi acheter ici",
            feature1: 'Stock mis à jour en temps réel',
            feature2: 'Achat sécurisé avec votre compte',
            feature3: 'Filtres et recherche',
        },
        vehicles: {
            title: 'Véhicules en vente',
            searchPlaceholder: 'Rechercher par marque ou modèle…',
            filterAll: 'Tous',
            filterCars: 'Voitures',
            filterMotos: 'Motos',
            table: {
                type: 'Type',
                brand: 'Marque',
                model: 'Modèle',
                year: 'Année',
                mileage: 'Km',
                fuel: 'Carburant',
                price: 'Prix',
                actions: 'Actions',
            },
            buy: 'Acheter',
            loginToBuy: 'Connectez-vous pour acheter',
            purchasedOk: 'Achat enregistré. Merci !',
            car: 'Voiture',
            motorcycle: 'Moto',
        },
    },
};

function get(obj, path) {
    return path.split('.').reduce((acc, k) => (acc && acc[k] !== undefined ? acc[k] : undefined), obj);
}

export function createI18n() {
    return {
        install(app) {
            app.provide(I18N_KEY, { messages });
        },
    };
}

export function useI18n() {
    const store = inject(I18N_KEY);
    const page = usePage();

    const locale = computed(() => page.props.locale || 'en');

    const t = (key) => {
        const dict = store?.messages?.[locale.value] ?? store?.messages?.en ?? {};
        return get(dict, key) ?? key;
    };

    return { t, locale };
}
