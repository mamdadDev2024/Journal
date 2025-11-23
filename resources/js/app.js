import Swiper from 'swiper/bundle';
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init();

document.addEventListener('alpine:init', () => {
    Alpine.data('validatorComponent', (rules) => ({
        parsed: [],

        translations: {
            required: "پر کردن این فیلد اجباری است",
            string: "باید متنی باشد",
            numeric: "باید عدد باشد",
            email: "ایمیل معتبر وارد کنید",
            url: "آدرس معتبر نیست",
            boolean: "باید مقدار بولین باشد",
            array: "باید آرایه باشد",

            max: p => `حداکثر ${p} کاراکتر`,
            min: p => `حداقل ${p} کاراکتر`,
            size: p => `باید دقیقا ${p} باشد`,
            between: p => {
                let [a, b] = p.split(',');
                return `باید بین ${a} تا ${b} باشد`;
            }
        },

        parse() {
            if (!rules) return;

            let items = rules.split('|');

            items.forEach(rule => {
                let [name, param] = rule.split(':');

                // اگر ترجمه وجود داشت
                if (this.translations[name]) {
                    let trans = this.translations[name];

                    this.parsed.push(
                        typeof trans === 'function' ? trans(param) : trans
                    );
                } else {
                    // fallback
                    this.parsed.push(rule);
                }
            });
        },

        init() {
            this.parse();
        }
    }));
});
