import Swiper from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

const heroCarousel = new Swiper("#heroCarousel", {
  loop: true,
  //   autoplay: {
  //     delay: 3000, // 3 seconds
  //     disableOnInteraction: false,
  //   },
  modules: [Navigation, Pagination, Autoplay],
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
});

const swiperOffers = new Swiper("#swiperOffers", {
  slidesPerView: "auto",
  spaceBetween: 15,
  navigation: {
    nextEl: "#swiperOffersNext",
    prevEl: "#swiperOffersPrev",
  },
  modules: [Navigation],
});

const swiperCategories = new Swiper("#swiperCategories", {
  slidesPerView: "auto",
  spaceBetween: 35,
  navigation: {
    nextEl: "#swiperCategoriesNext",
    prevEl: "#swiperCategoriesPrev",
  },
  modules: [Navigation],
});

const swiperBest = new Swiper("#swiperBest", {
  slidesPerView: "auto",
  spaceBetween: 15,
  navigation: {
    nextEl: "#swiperBestNext",
    prevEl: "#swiperBestPrev",
  },
  modules: [Navigation],
});

const swiperBrands = new Swiper("#swiperBrands", {
  slidesPerView: "auto",
  spaceBetween: 35,
  navigation: {
    nextEl: "#swiperBrandsNext",
    prevEl: "#swiperBrandsPrev",
  },
  modules: [Navigation],
});

const swiperTop = new Swiper("#swiperTop", {
  slidesPerView: "auto",
  spaceBetween: 15,
  navigation: {
    nextEl: "#swiperTopNext",
    prevEl: "#swiperTopPrev",
  },
  modules: [Navigation],
});

const swiperTopBrands = new Swiper("#swiperTopBrands", {
  slidesPerView: "auto",
  spaceBetween: 35,
  navigation: {
    nextEl: "#swiperTopBrandsNext",
    prevEl: "#swiperTopBrandsPrev",
  },
  modules: [Navigation],
});

const swiperMostSelling = new Swiper("#swiperMostSelling", {
  slidesPerView: "auto",
  spaceBetween: 15,
  navigation: {
    nextEl: "#swiperMostSellingNext",
    prevEl: "#swiperMostSellingPrev",
  },
  modules: [Navigation],
});
