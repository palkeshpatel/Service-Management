# Refactoring Plan

## 1. Chunked Uploads

- [ ] Implement chunked upload for large files (Deferred - Requires significant frontend refactoring)

## 2. Separation of Concerns (Controllers)

- [x] Create `PanelDamageController`
- [x] Create `JunctionBoxController`
- [x] Create `HotspotController`
- [x] Implement `store` method in each controller using `ServiceRequestService`
- [x] Update `routes/web.php` to use new controllers
- [x] Update `form.blade.php` to use dynamic action URLs

## 3. Validation Separation

- [x] Create `StorePanelDamageRequest`
- [x] Create `StoreJunctionBoxRequest`
- [x] Create `StoreHotspotRequest`
- [x] Define specific validation rules for each type

## 4. Error Logging

- [x] Create `ErrorLog` model and migration
- [x] Run migration
- [x] Implement try-catch in `ServiceRequestService`
- [x] Log errors to `error_logs` table

## 5. Standardization

- [x] Create `ApiResponse` trait (copied from pos-api)
- [x] Use `ApiResponse` trait in new controllers
- [x] Create `ServiceRequestService` to centralize logic

## 6. Verification

- [x] Verify code compiles (no syntax errors in created files)
- [x] Verify routes are correct
