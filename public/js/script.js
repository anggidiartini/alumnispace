/* ==========================================================
   JEJAK KELUARGA ALUMNI PLATFORM - SCRIPT.JS
   Interactive logic for view switching, login simulation, filtering, and AOS init
   ========================================================== */

document.addEventListener("DOMContentLoaded", function () {
    // Initialize AOS Animation Library
    AOS.init({
        once: true,
        offset: 50,
        duration: 800,
        easing: "ease-in-out",
    });

    // DOM Elements
    const landingView = document.getElementById("landingView");
    const homeView = document.getElementById("homeView");

    const loggedOutState = document.getElementById("loggedOutState");
    const loggedInState = document.getElementById("loggedInState");

    const loginBtn = document.getElementById("loginBtn");
    const heroLoginTrigger = document.getElementById("heroLoginTrigger");
    const loginModal = document.getElementById("loginModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const loginForm = document.getElementById("loginForm");
    const logoutBtn = document.getElementById("logoutBtn");

    const userProfileBadge = document.getElementById("userProfileDropdown");
    const userDropdownMenu = document.getElementById("userDropdownMenu");

    // Header scroll shadow effect
    window.addEventListener("scroll", function () {
        const header = document.getElementById("mainHeader");
        if (window.scrollY > 40) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });

    // Modal Trigger
    function openLoginModal() {
        loginModal.classList.add("active");
    }

    function closeLoginModal() {
        loginModal.classList.remove("active");
    }

    if (loginBtn) loginBtn.addEventListener("click", openLoginModal);
    if (heroLoginTrigger)
        heroLoginTrigger.addEventListener("click", openLoginModal);
    if (closeModalBtn) closeModalBtn.addEventListener("click", closeLoginModal);

    // Close modal when clicking outside
    loginModal.addEventListener("click", function (e) {
        if (e.target === loginModal) {
            closeLoginModal();
        }
    });

    // Simulate Login Action
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();
        closeLoginModal();
        switchToHomeView();
    });

    // Switch to Home View (Logged In state)
    function switchToHomeView() {
        // Toggle Auth Action state
        loggedOutState.classList.add("hidden");
        loggedInState.classList.remove("hidden");

        // Toggle Views
        landingView.classList.remove("active-view");
        homeView.classList.add("active-view");

        // Scroll to top smoothly
        window.scrollTo({ top: 0, behavior: "smooth" });

        // Refresh AOS animations
        setTimeout(() => {
            AOS.refresh();
        }, 200);
    }

    // Simulate Logout Action
    logoutBtn.addEventListener("click", function (e) {
        e.preventDefault();
        switchToLandingView();
    });

    // Switch to Landing View (Logged Out state)
    function switchToLandingView() {
        // Toggle Auth Action state
        loggedInState.classList.add("hidden");
        loggedOutState.classList.remove("hidden");

        // Toggle Views
        homeView.classList.remove("active-view");
        landingView.classList.add("active-view");

        // Close dropdown if open
        if (userDropdownMenu) {
            userDropdownMenu.classList.remove("show");
        }

        // Scroll to top
        window.scrollTo({ top: 0, behavior: "smooth" });

        setTimeout(() => {
            AOS.refresh();
        }, 200);
    }

    // User Profile Dropdown Toggle
    if (userProfileBadge) {
        userProfileBadge.addEventListener("click", function (e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle("show");
        });
    }

    window.addEventListener("click", function () {
        if (userDropdownMenu) {
            userDropdownMenu.classList.remove("show");
        }
    });

    // Job Category Filter Functionality
    const filterBtns = document.querySelectorAll(".filter-btn");
    const jobCards = document.querySelectorAll(".job-card-item");

    filterBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            filterBtns.forEach((b) => b.classList.remove("active"));
            this.classList.add("active");

            const filterValue = this.getAttribute("data-filter");

            jobCards.forEach((card) => {
                const cardCategory = card.getAttribute("data-category");
                if (filterValue === "all" || cardCategory === filterValue) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    });

    // Job Search Input Filter
    const jobSearchInput = document.getElementById("jobSearchInput");
    if (jobSearchInput) {
        jobSearchInput.addEventListener("input", function (e) {
            const term = e.target.value.toLowerCase();
            jobCards.forEach((card) => {
                const text = card.innerText.toLowerCase();
                if (text.includes(term)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    }

    // Alumni Search & Filter Simulation
    const searchAlumniBtn = document.getElementById("searchAlumniBtn");
    const alumniSearch = document.getElementById("alumniSearch");
    const generationFilter = document.getElementById("generationFilter");
    const alumniCards = document.querySelectorAll(".alumni-card");

    function filterAlumni() {
        const searchTerm = alumniSearch ? alumniSearch.value.toLowerCase() : "";
        const genValue = generationFilter ? generationFilter.value : "";

        alumniCards.forEach((card) => {
            const cardText = card.innerText.toLowerCase();
            const matchesSearch = cardText.includes(searchTerm);
            const matchesGen = genValue === "" || cardText.includes(genValue);

            if (matchesSearch && matchesGen) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    if (searchAlumniBtn) {
        searchAlumniBtn.addEventListener("click", filterAlumni);
    }
    if (alumniSearch) {
        alumniSearch.addEventListener("input", filterAlumni);
    }
    if (generationFilter) {
        generationFilter.addEventListener("change", filterAlumni);
    }
});
