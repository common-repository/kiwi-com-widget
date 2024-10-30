const configDefaults = {
  affiliateID: "skypicker",
};

export const kiwicomData = window.kiwicomData
  ? { ...configDefaults, ...window.kiwicomData }
  : configDefaults;
